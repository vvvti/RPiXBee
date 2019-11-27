import time
import serial
from xbee import XBee
from os import system
import RPi.GPIO as GPIO
import struct

ser = serial.Serial(
    port='/dev/ttyS0',
    baudrate = 9600,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS,
    timeout=1           
 )
xbee = XBee(ser)



while True:
    response = xbee.wait_read_frame()
    system('clear');
    print 'Temperatura '+response['rf_data'][8:-6]+' C'
    print 'Wilgotnosc '+response['rf_data'][13:-1]+' %'