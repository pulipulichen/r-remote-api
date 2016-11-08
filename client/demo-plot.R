# 取得圖表路徑跟輸入的parameters
args <- commandArgs(TRUE)

# 將args[1]設為圖表的檔案路徑及名稱
plot.filename <- args[1]
# 設置將圖表儲存到以下路徑
png(plot.filename) 

# 用亂數繪製直方圖
x <- rnorm(100,0,1)
hist(x, col="lightblue")