#!/usr/bin/env python
import time
import serial
from xbee import XBee
import RPi.GPIO as GPIO
import struct

ser = serial.Serial(
    port='/dev/ttyS0',
    baudrate=9600,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS,
    timeout=1
)
xbee = XBee(ser)
while True:
    response = xbee.wait_read_frame()
    f = open("/var/www/html/data", "w")
    f.write(response['rf_data'][8:-1]);
    f.close()
    print response['rf_data'][8:-1]
