#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>

#define RST_PIN 4
#define SS_PIN  5

MFRC522 mfrc522(SS_PIN, RST_PIN);

int Led_OnBoard = 2;
String iData1 = "1";
String iData2 = "2";
String iData3 = "3";
String iData4 = "4";
const int buzz = 0;
String statusP = "pinjam";
String postData;
String Data1;
String Data2;
String Data3;
String Data4;
String host = "192.168.123.123";
const char* ssid = "LIMITED";
const char* password = "12344321";

String url = "http://" + host + "/krenova/GitFolder/Peminjaman-Buku-1/PHP/stock.php";

void setup() {
  Serial.begin(115200);
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wi-Fi");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(250);
    delay(250);
    Serial.print(".");
  }
  Serial.println("OK.");
  digitalWrite(Led_OnBoard, HIGH);
  Serial.println("Connected to Network/SSID");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  pinMode(Led_OnBoard, OUTPUT);
  pinMode(buzz, OUTPUT);
  SPI.begin();
  mfrc522.PCD_Init();
}

void loop() {
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  iData1 = scann();
  delay(1000);
  iData2 = scann();
  uploadDB(iData1, iData2, statusP, iData4);
  delay(2000);
}

String scann() {
  while ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
  }
  
  while ( ! mfrc522.PICC_ReadCardSerial()) 
  {
  }
  digitalWrite(buzz, HIGH);
  delay(100);
  digitalWrite(buzz, LOW);
  Serial.print("UID :");
  String guid;
  String content= "";
  byte letter;
  
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
     Serial.print(mfrc522.uid.uidByte[i], HEX);
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  
  Serial.println();
  content.toUpperCase();
  guid = content.substring(1);
  guid.replace(" ", "");
  return guid;
}

void uploadDB(String satu,String dua, String tiga, String empat) {
  HTTPClient http;
  Data1 = String(satu);
  Data2 = String(dua);
  Data3 = String(tiga);
  Data4 = String(empat);
 
  postData = "Data1=" + Data1 + "&Data2=" + Data2 + "&Data3=" + Data3 + "&Data4=" + Data4 ;
  Serial.println(postData);
 
  http.begin(url);
  Serial.println(url);
  
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  digitalWrite(Led_OnBoard, LOW);
  
  int httpCode = http.POST(postData);
  String payload = http.getString();

  Serial.println(httpCode);
  
  http.end();
  digitalWrite(Led_OnBoard, HIGH);
}
