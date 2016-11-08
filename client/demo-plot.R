args <- commandArgs(TRUE)
plot.filename <- args[1]

x <- rnorm(1006,0,1)

png(plot.filename)
hist(x, col="lightblue")