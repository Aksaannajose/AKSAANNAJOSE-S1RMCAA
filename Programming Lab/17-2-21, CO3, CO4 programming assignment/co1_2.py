def leap(year):
    c=2021
    while c<=year:
        if c%4!=0 and c%400!=0:
            c+=1
        elif c%100!=0:
            print(c)
            c+=1
n=int(input("enter the year:"))
leap(n)