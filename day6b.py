
fishes = [5]
days = 256

for i in range(days) :
  for j in range(len(fishes)) :
    if fishes[j] == 0 :
      fishes[j] = 6
      fishes.append( 8 )
    else :
      fishes[j] = fishes[j] - 1
  print ("Day "+str(i)+" "+str(len(fishes))+" Fish")
