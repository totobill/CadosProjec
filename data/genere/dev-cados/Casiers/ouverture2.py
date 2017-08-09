#!/usr/local/bin/python3

import sys
import RPi.GPIO as GPIO
import time

# Configure the GPIO pin
GPIO.setmode(GPIO.BCM)
LOCK_PIN = 18
OPEN_TIME = 5

GPIO.setup(LOCK_PIN, GPIO.OUT)

def unlock_door():
	GPIO.output(LOCK_PIN,True)
	

def lock_door():
	GPIO.output(LOCK_PIN,False)


#print(sys.argv[1]) 
num_casier = sys.argv[1]    

success = True

if success :
	unlock_door()
	time.sleep(OPEN_TIME)
	print( 'casier ouvert')
else:
    print('probleme ouverture casier')
GPIO.cleanup()
