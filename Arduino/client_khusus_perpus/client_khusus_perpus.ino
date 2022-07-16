#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_MLX90614.h>

#define RST_PIN 4
#define SS_PIN  5

//SUHU && LCD
//SDA - G21
//SCL - G22
//
//RFID
//RST - G4
//MISO - G19
//MOSI - G23
//SDA - G5
//SCK - G18
//
//IR
//OUT - G25
//
//BUTTON
//1 - G26
//2 - G27
//
//BUZZ
//+ - G0

MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd (0x27, 16, 2);
Adafruit_MLX90614 mlx = Adafruit_MLX90614();

int Led_OnBoard = 2;
const int buzz = 0;
const int ir = 25;
const int b1 = 26;
const int b2 = 27;


bool quit = 0;
String iData1 = "1";
String iData2 = "2";
String iData3 = "3";
String iData4 = "36";

float temp;
String stats = "";
String sendMode = "absen";
String postData;
String Data1;
String Data2;
String Data3;
String Data4;
//String host = "192.168.149.135";
//String host = "testingstarproject.000webhostapp.com";
String host = "wirapustaka.ninapst.com";
const char* ssid = "LIMITEeD";
const char* password = "12344321";

//String url = "http://" + host + "/Krenova/GitFolder/Peminjaman-Buku-1/PHP/admin/fungsiAdmin.php";
//String url = "https://" + host + "/index.php";
String url = "http://" + host + "/admin/fungsiAdmin.php";
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
  int hb1 = digitalRead(b1);
  int hb2 = digitalRead(b2);
  int hir = digitalRead(ir);
  Serial.print(hir);
  Serial.print(hb1);
  Serial.println(hb2);
  delay(50);
  if ( hb1 == 0 ) {
    Serial.println("Pinjam");
    
    perpus("pinjam");
  }
  else if ( hb2 == 0 ) {
    Serial.println("Kembali");
    perpus("kembali");
  }
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  if (quit == 1 ) {
    quit = 0;
    
    return;
  }
  buzer1();
  absen();
  
  
  Serial.print("suadah enddd");
//  iData1 = scann();
//  delay(1000);
//  iData2 = scann();
//  uploadDB(iData1, iData2, sendMode, iData4);
//  delay(2000);
}

String scann() {
  int hir = digitalRead(ir);
  while ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
  }
  while ( ! mfrc522.PICC_ReadCardSerial()) 
  {
  }
  buzer1();
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
 
  postData = "Data1=" + Data1 + "&Data2=" + Data2 + "&Data3=" + Data3 + "&sendMode=" + Data4 ;
  Serial.println(postData);
 
  http.begin(url);
  Serial.println(url);
  
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  digitalWrite(Led_OnBoard, LOW);
  
  int httpCode = http.POST(postData);
  Serial.print("uploading");
  int c = 0;
  while (httpCode != 200){
            Serial.print(".");
            Serial.print(httpCode);
            httpCode = http.POST(postData);
            delay(500);
            c++;
            if (c == 10 ) {
              http.begin(url);
              Serial.println(url);
              http.addHeader("Content-Type", "application/x-www-form-urlencoded");
              digitalWrite(Led_OnBoard, LOW);
              httpCode = http.POST(postData);
            }
            if (c == 35 ) {
              Serial.println("Reset..");
              ESP.restart();
            }
          }
  String payload = http.getString();

  Serial.println(httpCode);
  
  http.end();
  digitalWrite(Led_OnBoard, HIGH);
}


void perpus(String SM) {
  sendMode = SM;
  buzer1();
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
      uploadDB(dataUpload[0], dataUpload[1], iData4, sendMode);
      break;
      
    default:
      Serial.print("duaaaaaaaaaa");
      for(int a=1;a<u;a++){
        uploadDB(dataUpload[0], dataUpload[a], iData4, sendMode);
       }
      break;
  }
 
    sendMode = "absen";
}

void absen() {
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
  Serial.print("Dekatkan tanganmu");
  int hir = digitalRead(ir);
  while (hir == 1 ) {
    Serial.print(".");
    delay(100);
    hir = digitalRead(ir);
    Serial.print(hir);
  }
  Serial.println("");
  delay(400);
  temp = mlx.readObjectTempC();
  temp = temp + 1.7;
  Serial.println(temp);
  buzer1();
  if (temp >= 37){
    stats = "Bahaya";
  }
  else {
    stats = "Aman";
  }
  
  lcd.clear();
  lcd.setCursor (0,0);
  lcd.print("Uploading..");
  lcd.setCursor (0,1);
  lcd.print("Suhu : ");
  lcd.print(temp);
  lcd.print((char)223);
  lcd.print("C");
  Serial.println("uploading..");
  String te = String(temp);
  uploadDB(guid, te, iData2, sendMode);
  lcd.clear();
}


void buzer1() {
  digitalWrite(buzz, HIGH);
  delay(100);
  digitalWrite(buzz, LOW);
  delay(100);
}
