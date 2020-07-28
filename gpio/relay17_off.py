#!/usr/bin/env python

import RPi.GPIO as GPIO
RELAIS_1_GPIO = 17

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(RELAIS_1_GPIO, GPIO.OUT)
GPIO.output(RELAIS_1_GPIO, GPIO.LOW)

