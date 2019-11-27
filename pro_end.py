import time
import serial
from xbee import XBee
import RPi.GPIO as GPIO
import Adafruit_DHT
import sys

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
    humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.DHT11, 23)

    if humidity is not None and temperature is not None:
        temHum = 'Temp={0:0.1f}  Humidity={1:0.1f}'.format(
            temperature, humidity)
        xbee.tx(dest_addr='\x00\x02', data=temHum)
        # print(temHum);
    else:
        xbee.tx(dest_addr='\x00\x02', data='Failed to get reading.')

    time.sleep(2)