#!/usr/bin/env python

import RPi.GPIO as GPIO
import sys

RELAIS_1_GPIO = int(sys.argv[1])

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(RELAIS_1_GPIO, GPIO.OUT)

if sys.argv[2] == "low":
    GPIO.output(RELAIS_1_GPIO, GPIO.LOW)
else:
    GPIO.output(RELAIS_1_GPIO, GPIO.HIGH)
