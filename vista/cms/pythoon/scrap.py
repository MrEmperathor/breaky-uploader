
#!/usr/bin/env python    
from bs4 import BeautifulSoup
import argparse
import requests
import json
# from requests.utils import requote_uri

def grouper(iterable, n):
    args = [iter(iterable)] * n
    return zip(*args)

class App:
    def __init__(self, url):
        self.url = url
        self.data = {}
        self.data['movies'] = []
        
    def buscarEnlaces(self):
        page = requests.get(self.url)
        soup = BeautifulSoup(page.content, 'html.parser')
        search = soup.find_all('li', class_='xxx')
        # print(search[0].find(class_='Date AAIco-date_range').text)
        # print(search[0].find('img', attrs={'class':'lazy'})['data-src'])
        for post in search:
            url_peli = post.find_all('a',href=True)[0].get('href')
            titulo = post.find(class_='Title').text
            year = post.find(class_='Date AAIco-date_range').text
            image = post.find('img', attrs={'class':'lazy'})['data-src']
            
            self.data['movies'].append({
                "url": url_peli,
                "titulo": titulo,
                "year": year,
                "image": image
            })
        return self.data
    
    def postMovie(self, ur=None):
        if ur == None:
            page = requests.get(self.url)
        else:
            page = requests.get(ur)
            
        soup = BeautifulSoup(page.content, 'html.parser')
        search = soup.find_all('div', class_='TPTblCn')
        th = search[0].find_all('th')
        td = search[0].find_all('td')
        
        # datos = ["juan", 18, "masculino", "camilo", 25, "masculino", "luisa", 23, "femenino"]
        # self.info = [dict(servidor=td[i].text[4:], idioma=td[i+1].text, calidad=td[i+2].text, link=td[i+3].find('a',href=True).get('href')) for i in range(0,len(td),4)]
        self.info = [dict(servidor=ser.text[4:], idioma=idi.text, calidad=cal.text, link=lin.find('a',href=True).get('href')[37:] if 'goto.php' in lin.find('a',href=True).get('href') else lin.find('a',href=True).get('href')) for ser,idi,cal,lin in grouper(td,4)]
        
        itera = 0
        for v in self.info:
            if 'uptobox' in v["link"] or 'http' in v["link"]:
                v["link"] = v["link"]
            else:
                url_api1 = 'https://api.cuevana3.io/uptobox/api.php'
                myobj = {'h': v["link"]}
                x = requests.post(url_api1, data = myobj).text
                xx = json.loads(x)
                self.info[itera]["link"] = xx["url"]
            itera += 1
        return self.info
    
    
    def listSeries(self):
        pass
    def datosSerie(self):
        t = {}
        fara = {}
        page = requests.get(self.url)
        soup = BeautifulSoup(page.content, 'html.parser')
        soup2 = soup.find_all('ul', class_='all-episodes')
        
        image = soup.find('img', attrs={'class':'lazy'})['data-src']
        titulo = soup.find(class_='Title').text
        descripcion = soup.find(class_='Description').text
        fara["img"] = image
        fara["titulo"] = titulo
        fara["descripcion"] = descripcion

        for a,u in enumerate(soup2):
            te = []
            sal = soup2[a].find_all('li', class_='xxx')
            for i in sal:
                # print(i.find_all('a',href=True)[0].get('href'))
                te.append(i.find_all('a',href=True)[0].get('href'))
                # print(i.find_all('a',href=True)[0].get('href'))
            t["temporada "+str(a+1)] = te
        return t,fara




parser = argparse.ArgumentParser()
parser.add_argument("-v", "--verbose", help="Mostrar información de depuración", action="store_true")
parser.add_argument("-i", "--url", help="Post url individual")
parser.add_argument("-l", "--link", help="link pagina principal")
parser.add_argument("-s", "--serie", help="Listado de paginas series")
args = parser.parse_args()

if args.link:
    r = App(args.link)
    print(r.buscarEnlaces())
elif args.url:
    r = App(args.url)
    print(r.postMovie())
elif args.serie:
    r = App(args.serie)
    # print(r.datosSerie())
    (c,fara) = r.datosSerie()   #devuelve un json con enlaces de los capitulos
    data = {}
    sjson = {}
    for i in c:
        jenla = []
        for s in c[i]:      #iterando por temporadas
            jenla.append(r.postMovie(s))
        sjson[i] = jenla
    data["info"] = fara
    data["enlaces"] = sjson
    print(data)
    
    # print(r.postMovie())
    
    # result = r.sal()
    
    # id_db = args.id
    # cliente = Cliente_mega(user, contra, 'aaaa.txt')
    # fil = cliente.mimega_import_link(args.link)
    # link = cliente.mimega_link(fil)
    # return resutl