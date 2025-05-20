import RPi.GPIO as GPIO
import time
import requests
import json
from mfrc522 import SimpleMFRC522
from picamera import PiCamera
from pyzbar.pyzbar import decode
import cv2
import numpy as np

# Konfigurasi GPIO
GPIO.setmode(GPIO.BCM)
SERVO_PIN = 18
GPIO.setup(SERVO_PIN, GPIO.OUT)
servo = GPIO.PWM(SERVO_PIN, 50)
servo.start(0)

# Konfigurasi Keypad
ROWS = [17, 27, 22, 23]
COLS = [24, 25, 8, 7]
KEYS = [
    ['1', '2', '3', 'A'],
    ['4', '5', '6', 'B'],
    ['7', '8', '9', 'C'],
    ['*', '0', '#', 'D']
]

# Setup keypad
for row in ROWS:
    GPIO.setup(row, GPIO.OUT)
for col in COLS:
    GPIO.setup(col, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

# Inisialisasi RFID reader
rfid = SimpleMFRC522()

# Inisialisasi kamera
camera = PiCamera()
camera.resolution = (640, 480)

# Konfigurasi API
API_URL = "http://your-laravel-app.com/api"

def read_keypad():
    key = None
    for i, row in enumerate(ROWS):
        GPIO.output(row, GPIO.HIGH)
        for j, col in enumerate(COLS):
            if GPIO.input(col) == GPIO.HIGH:
                key = KEYS[i][j]
                while GPIO.input(col) == GPIO.HIGH:
                    time.sleep(0.1)
        GPIO.output(row, GPIO.LOW)
    return key

def open_gate():
    servo.ChangeDutyCycle(7.5)  # 90 derajat
    time.sleep(2)
    servo.ChangeDutyCycle(2.5)  # Kembali ke posisi awal

def read_qr_code():
    camera.start_preview()
    time.sleep(2)
    camera.capture('temp.jpg')
    camera.stop_preview()
    
    image = cv2.imread('temp.jpg')
    decoded_objects = decode(image)
    
    if decoded_objects:
        for obj in decoded_objects:
            data = obj.data.decode('utf-8')
            return data
    return None

def verify_ticket(ticket_code):
    try:
        response = requests.get(f"{API_URL}/tickets/verify/{ticket_code}")
        data = response.json()
        return data['status'] == 'valid'
    except:
        return False

def register_rfid_card():
    print("Silakan scan kartu RFID baru...")
    id, text = rfid.read()
    print(f"ID Kartu: {id}")
    
    name = input("Masukkan nama: ")
    email = input("Masukkan email: ")
    nim = input("Masukkan NIM (opsional): ")
    
    try:
        response = requests.post(f"{API_URL}/rfid-cards", json={
            'card_number': str(id),
            'name': name,
            'email': email,
            'nim': nim
        })
        if response.status_code == 200:
            print("Kartu berhasil didaftarkan!")
        else:
            print("Gagal mendaftarkan kartu.")
    except:
        print("Terjadi kesalahan saat mendaftarkan kartu.")

def main():
    print("Sistem Tiket Pintar")
    print("1. Mode Normal")
    print("2. Mode Daftar Kartu")
    mode = input("Pilih mode (1/2): ")
    
    if mode == "2":
        register_rfid_card()
        return
    
    while True:
        print("\nMenunggu input...")
        print("1. Scan QR Code")
        print("2. Scan RFID Card")
        print("3. Keypad")
        
        choice = input("Pilih metode (1/2/3): ")
        
        if choice == "1":
            qr_data = read_qr_code()
            if qr_data and verify_ticket(qr_data):
                print("Tiket valid! Membuka gerbang...")
                open_gate()
            else:
                print("Tiket tidak valid!")
                
        elif choice == "2":
            print("Silakan scan kartu RFID...")
            id, text = rfid.read()
            try:
                response = requests.get(f"{API_URL}/rfid-cards/{id}")
                if response.status_code == 200:
                    print("Kartu valid! Membuka gerbang...")
                    open_gate()
                else:
                    print("Kartu tidak valid!")
            except:
                print("Terjadi kesalahan saat verifikasi kartu.")
                
        elif choice == "3":
            print("Masukkan kode:")
            code = ""
            for _ in range(4):
                key = read_keypad()
                if key:
                    code += key
                    print("*", end="", flush=True)
            print()
            
            if code == "1234":
                print("Kode benar! Membuka gerbang...")
                open_gate()
            elif code == "A123":
                register_rfid_card()
            else:
                print("Kode salah!")

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nProgram dihentikan.")
    finally:
        GPIO.cleanup() 