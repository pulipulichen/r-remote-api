# Server端安裝工作

1. Apache使用者設成跟RStudio Server相同使用者
/etc/apache2/envvars

修改以下設定
export APACHE_RUN_USER=rstudio
export APACHE_RUN_GROUP=rstudio

2. R本身加上預設語系
/etc/R/Renviron
LANG = "en_US.UTF-8"

3. 在Linux安裝中文字形

字形存到以下資料夾
/usr/share/fonts/

快取字形
fc-cache -fv


