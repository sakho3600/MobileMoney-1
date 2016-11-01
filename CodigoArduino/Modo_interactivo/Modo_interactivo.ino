#include <SoftwareSerial.h>
int pwrKey = 5;
int dtr = 4;
String K="";
bool Status_pwrKey = false;
bool conf_init_UC20=false;
bool conet=false;
//*************************Zona de Configuracion Serial***********************
SoftwareSerial UC20(11,12); //RX=2  TX=3
//**************************** Zona De Rutina Encendido **********************
void encender(){digitalWrite(pwrKey,HIGH);delay(200);digitalWrite(pwrKey,LOW);Serial.println("Sistema Encendido");Status_pwrKey = true;}
//***********************configuracion de coneccion***************************
//int Coect()
//{UC20.println("AT");
//while(palabra()=="O K"){Serial.println("Conectado");}conet=true;}
//***********************   Lectura de mensaje         **********************

//***********************Zona De configuracion de UC20 ***********************

void init_UC20()
{
  UC20.println("ATV1");
  UC20.println("ATV1");
  UC20.println("ATE1");
  UC20.println("AT+CMEE=2");
  UC20.println("AT+CIMI");
  UC20.println("AT+CSQ ");
  UC20.println("AT+CSQ ");
  UC20.println("ATE1 ");
  UC20.println("ATE1 ");
  UC20.println("AT+CMGF=1");
  UC20.println("AT+CMGR=?");
   UC20.println("AT+CNMI=2,2,0,0");
  
  Serial.println("Sistema configurado");
  Serial.println("********************************** Modo Interactivo*************************");
  conf_init_UC20=true;
}
// **********************+***Zona configuracion de Arduino*******************************
void setup() 
{
  Serial.begin(9600);//Velocidad de Puerto serie ARDUINO
  UC20.begin(9600);  //Velocidad de Puerto serie UC20
  pinMode(pwrKey, OUTPUT);  digitalWrite(pwrKey, LOW);//configuracion puerto de Encendido;
}
//*******************************zona de programa****************************************
void loop() 
{
 
  if(conf_init_UC20==false){encender();}
  
  if(conf_init_UC20==false){init_UC20();}

  
  if (UC20.available())
    Serial.write(UC20.read());

 
  if (Serial.available())
    UC20.write(Serial.read());

}
