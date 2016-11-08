# 取得圖表路徑跟輸入的parameters
args <- commandArgs(TRUE)

# 因為args[1]是圖表的檔案路徑及名稱，在此不能使用
# 實際上paramters是從args[2]開始計算

# 將parameters第一個參數設為最小值，用strtoi()將字串轉換成整數
min<-strtoi(args[2])
# 將parameters第二個參數設為最大值，用strtoi()將字串轉換成整數
max<-strtoi(args[3])

# 用c()組成陣列
data<-c(min:max)

# 用mean()計算平均，並以cat()輸出。用cat()輸出則不會顯示row name
cat(mean(data))