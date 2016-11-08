args <- commandArgs(TRUE)

min<-strtoi(args[2])
max<-strtoi(args[3])
cat(mean(c(min:max)))
#mean(c(0:10,50)
#cat(args[2])