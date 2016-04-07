#include "DHT.h"
#include <SoftwareSerial.h>

SoftwareSerial SIM900(7, 8); // configure software serial port
#define DHTPIN 2     // what digital pin we're connected to
// Uncomment whatever type you're using!
#define DHTTYPE DHT11   // DHT 22  (AM2302), AM2321
const int gasPin = A1;
DHT dht(A0, DHTTYPE);

void setup() {
  SIM900.begin(19200);
  Serial.begin(19200); 
  Serial.print("power up" );
  delay(30000); 
  Serial.println("DHTxx test!");
  dht.begin();
}
void loop() {
  // Wait a few seconds between measurements.
  delay(2000);

  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f = analogRead(gasPin);

  // Check if any reads failed and exit early (to try again).
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
String a = String(t);
String all = "/"+a+"/"+h+"/"+f ;
  Serial.println("SubmitHttpRequest - started" );
  SubmitHttpRequest(all);
  Serial.println("SubmitHttpRequest - finished" );
  delay(10000);
  
}



void SubmitHttpRequest(String data)
{
 
  SIM900.println("AT+CSQ"); // Signal quality check

  delay(100);
 
  
  SIM900.println("AT+CGATT?"); //Attach or Detach from GPRS Support
  delay(100);
 
  SIM900.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");//setting the SAPBR, the connection type is using gprs
  delay(1000);
 
 
  SIM900.println("AT+SAPBR=3,1,\"APN\",\"jawalnet.com.sa\"");//setting the APN, Access point name string
  delay(4000);
 
 
  SIM900.println("AT+SAPBR=1,1");//setting the SAPBR
  delay(2000);
 
 
  SIM900.println("AT+HTTPINIT"); //init the HTTP request
 
  delay(2000); 
 
  SIM900.println("AT+HTTPPARA=\"URL\",\"3zcs.net/webs/data/post"+data+"\"");// setting the httppara, the second parameter is the website you want to access
  delay(1000);
 
 
  SIM900.println("AT+HTTPACTION=0");//submit the request 
  delay(10000);//the delay is very important, the delay time is base on the return from the website, if the return datas are very large, the time required longer.
  //while(!SIM900.available());

 
  SIM900.println("");
  delay(100);
}
 
