#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd (0x27, 16, 2);
//D4() - SDA
//D5() - SCK
//D7() - MOSI
//D6() - MISO
//NULL - IRQ
//GND - GND
//D3()- RST
//3V - 3.3V

#define RST_PIN         0          // Configurable, see typical pin layout above
#define SS_PIN          2
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.

const int btn = 16;
int button;

bool quit = 0;
String iData1 = "1";
String iData2 = "2";
String iData3 = "3";
String iData4 = "36";

float temp;
String stats = "";
String sendMode = "tambahBuku";
String postData;
String Data1;
String Data2;
String Data3;
String Data4;
String host = "192.168.100.101";
//String host = "testingstarproject.000webhostapp.com";
const char* ssid = "LIMITED";
const char* password = "12344321";

String url = "http://" + host + "/Krenova/GitFolder/Peminjaman-Buku-1/PHP/admin/index.php";
//String url = "https://" + host + "/index.php";
String dataUpload[10];


void setup() {
  Serial.begin(115200);
  pinMode(btn, INPUT);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wi-Fi");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  Serial.println("OK.");
  Serial.println("Connected to Network/SSID");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  SPI.begin(); // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522
  
  lcd.init();
  lcd.backlight();
  lcd.clear();
}

void loop() {
  lcd.setCursor (0,0);
  lcd.print("staty..");
  lcd.setCursor (0,1);
  lcd.print("Suhu : ");
  lcd.print((char)223);
  lcd.print("C");
  button = digitalRead(btn);
  Serial.println(button);
  delay(50);
  if ( button == 1 ) {
    lcd.setCursor (0,0);
  lcd.print("tambahAnggota..");
    sendMode = "tambahAnggota";
    tambahAnggota();
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
  lcd.setCursor (0,0);
  lcd.print("TambajBUku..");
  sendMode = "tambahBuku";
  tambahBuku();
  
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
    delay(50);
  }
  while ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    delay(50);
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

void uploadDB(String satu, String dua, String tiga, String empat) {
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
}

void tambahBuku() {
  buzer1();
  dataUpload[0] = scann();
  Serial.print(dataUpload[0]);
  delay(700);
  uploadDB(dataUpload[0], iData2, iData4, sendMode);
 
}

void tambahAnggota() {
  buzer1();
  dataUpload[0] = scann();
  Serial.print(dataUpload[0]);
  delay(700);
  uploadDB(dataUpload[0], iData2, iData4, sendMode);
 
}

void buzer1() {
}
