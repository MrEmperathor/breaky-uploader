from urllib.request import urlopen
import requests
from urllib.parse import urlparse
import argparse
import shlex, subprocess
import time
import json



class MyAppFembed():
    def __init__(self):
        
        parser = argparse.ArgumentParser()
        parser.add_argument("-c", "--calidad", help="Nombre de id De Google Drive")
        parser.add_argument("-L", "--link", help="url fembed a descargar")
        args = parser.parse_args()
        
        # "https://www.fembed.com/f/pwdd1im81nq068r"
        # Aquí procesamos lo que se tiene que hacer con cada argumento
        if args.link:
            self.url_inicial = args.link
            self.headers = {"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36"}
            self.resp = requests.get(self.url_inicial, headers=self.headers)
            self.url_api_final = self.resp.url.replace("/f/", "/api/source/")
            # print(self.url_api_final)
            # print(self.resp)
            # print(self.resp.headers)
            # print(self.resp.text)
            # print(self.resp.encoding)
            self.url_api_final = self.url_api_final.replace("//www.", "//")
            # print(self.url_api_final)
            
            
            time.sleep(10)
            self.r = requests.post(self.url_api_final).json()
            # self.r = requests.post(self.url_api_final)
            # print(self.r)
            # print(self.r.text)
            # print(self.r.encoding)
            # print(self.r)
            for i in self.r["data"]:
                if i["label"] == "720p":
                    # de3 -n "LA HISTORIA SIN FIN 2 1990" -i "LATINO" -c 720 -t 34636 '1uheHW0H6lCBi-3dArsxcgPlVaGUXZ_9m'  -K 720 -B true; de2 -n "LA HISTORIA SIN FIN 2 1990" -i "LATINO" -c 720 -t 34636  -K 720 
                    listo = i["file"]
                    # print("720p")
            if listo:
                print(listo)
            else:
                print("Aun No esta lista la calidad 720p:", self.resp)
                    
                    # print(i["file"])
                    # wget.download(i["file"], '.'+self.title)
                    # linkk = 'aria2c -x16 -s16 "'+i["file"]+'" -o "'+self.title+'"'
                    # print(linkk)
                    # input()
                    # subprocess.call(shlex.split(linkk))
                    # print("File Downloaded")
                    # print()
MyAppFembed()