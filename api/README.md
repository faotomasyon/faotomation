## API Hakkında

Bu projenin API kısmı hazırlanirken yazılım dili olarak PHP ve framework olarak [Slim Micro Framework'ü](https://www.slimframework.com/) kullanılmıştır. 

Log tutmak için [Monolog](https://github.com/Seldaek/monolog) kütüphanesi kullanılmıştır.

## Projenin amacı
 Futbol Altyapı Akademilerinde futbolcunun antremanlara devamlılığı ve antremanda elde ettiği istatistikleri tek bir platform üzerinden takip etmesini ve otomatik yoklama, antreman saatini hatırlatma gibi özellikler barındırmaktadır.

## Docker ile çalıştırmak

İlk olarak /api dosyası altında olduğunuzdan emin olunuz. Daha sonra aşağıdaki composer komutunu çalıştırınız. Gerekli kütüphaneleri kurduktan sonra projeyi docker container'ı olarak ayağa kaldırmaya hazırız.

* composer
  ```sh
  php composer.phar install
    ```

/api dosyası altında iken aşağıdaki komutunu çalıştırdıktan sonra container'lar ayağa kalkacaktır.

* docker
  ```sh
  docker compose up 
    ```

Container'lar çalışır hale geldikten sonra projeyi test verileri ile doldurmak için scripts klasörü altındaki seeder.php script'i aşağıdaki komutunu kullanarak çalıştırınız
* php
  ```bash
  php seeder.php
    ```

## Erişim

Aşağıdaki adresden projeye erişebilirsiniz.
```bash
http://localhost:8000/
```


PhpMyAdmin'e erişmek için aşağıdaki adresi ve bilgileri kullanınız.
```bash
http://localhost:8080/
```

* Server: 
  - db

* Username: 
  - faotomation

* Password: 
  - faotomation




## Katkı
Pull request'ler kabul edilir, lütfen çekinmeyin. Büyük değişiklikler için lütfen önce neyi değiştirmek istediğinizi tartışmak üzere bir konu olarak açınız. Teşekkürler.

   