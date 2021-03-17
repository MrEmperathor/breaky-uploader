from urllib.request import urlopen
import requests
from urllib.parse import urlparse
import argparse
import shlex, subprocess


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
            self.resp = requests.get(self.url_inicial)
            self.url_api_final = self.resp.url.replace("/f/", "/api/source/")
            self.r = requests.post(self.url_api_final).json()
            
            for i in self.r["data"]:
                if i["label"] == "720p":
                    # de3 -n "LA HISTORIA SIN FIN 2 1990" -i "LATINO" -c 720 -t 34636 '1uheHW0H6lCBi-3dArsxcgPlVaGUXZ_9m'  -K 720 -B true; de2 -n "LA HISTORIA SIN FIN 2 1990" -i "LATINO" -c 720 -t 34636  -K 720 
                    listo = i["file"]
                    # print("720p")
            
            if listo:
                print(listo)
            else:
                print("Aun No esta lista la calidad 720p")
                    
                    # print(i["file"])
                    # wget.download(i["file"], '.'+self.title)
                    # linkk = 'aria2c -x16 -s16 "'+i["file"]+'" -o "'+self.title+'"'
                    # print(linkk)
                    # input()
                    # subprocess.call(shlex.split(linkk))
                    # print("File Downloaded")
                    # print()
MyAppFembed()