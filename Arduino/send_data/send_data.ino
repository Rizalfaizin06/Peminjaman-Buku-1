#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_MLX90614.h>

#define RST_PIN 4
#define SS_PIN  5

MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd (0x27, 16, 2);
Adafruit_MLX90614 mlx = Adafruit_MLX90614();

int Led_OnBoard = 2;
const int buzz = 0;
const int ir = 25;
const int b1 = 26;
const int b2 = 27;

String iData1 = "1";
String iData2 = "2";
String iData3 = "3";
String iData4 = "36";



float temp;
String sendMode = "pinjam";
String postData;
String Data1;
String Data2;
String Data3;
String Data4;
String host = "192.168.100.222";
//String host = "testingstarproject.000webhostapp.com";
const char* ssid = "LIMITED";
const char* password = "12344321";

String url = "http://" + host + "/krenova/GitFolder/Peminjaman-Buku-1/PHP/index.php";
//String url = "https://" + host + "/index.php";
String dataUpload[10];

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
  pinMode(b1, INPUT_PULLUP);
  pinMode(b2, INPUT_PULLUP);
  pinMode(ir, INPUT_PULLUP);
  pinMode(buzz, OUTPUT);
  SPI.begin();
  mfrc522.PCD_Init();
  mlx.begin();
  lcd.init();
  lcd.backlight();
}



void loop() {
//  int hb1 = digitalRead(b1);
//  int hb2 = digitalRead(b2);
//  int hir = digitalRead(ir);
//  Serial.print(hir);
//  Serial.print(hb1);
//  Serial.println(hb2);
//  delay(1000);
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  pinjam();
  Serial.print("suadah enddd");
//  iData1 = scann();
//  delay(1000);
//  iData2 = scann();
//  uploadDB(iData1, iData2, sendMode, iData4);
//  delay(2000);
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
//  Serial.print("UID :");
  String guid;
  String content= "";
  byte letter;
  
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
//     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
//     Serial.print(mfrc522.uid.uidByte[i], HEX);
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
  Serial.print("uploading");
  while (httpCode != 200){
            Serial.print(".");
            delay(500);
          }
  if (httpCode != 200){
    Serial.println("Reset..");
    ESP.restart();
  }
  String payload = http.getString();

  Serial.println(httpCode);
  
  http.end();
  digitalWrite(Led_OnBoard, HIGH);
}


void pinjam() {
  dataUpload[0] = scann();
  Serial.print(dataUpload[0]);
  delay(700);
  int i = 1;
  dataUpload[i] = scann();
  delay(700);
  
  while (dataUpload[0] != dataUpload[i]) {
    Serial.print(dataUpload[i]);
    i++;
    dataUpload[i] = scann();
      delay(700);
    
  }
  
  for(int a=0;a<i;a++){
    Serial.print("   Data : ");
    Serial.print(dataUpload[a]); //Display array values
  }
  int u = i;
  i--;
  Serial.print(i);
  
  switch (i) {
    case 1:
      Serial.print("satuuuuuu");
      uploadDB(dataUpload[0], dataUpload[1], "pinjam", iData4);
      break;
      
    default:
      Serial.print("duaaaaaaaaaa");
      for(int a=1;a<u;a++){
        uploadDB(dataUpload[0], dataUpload[a], "pinjam", iData4);
       }
      break;
  }
 
}
