#-*- coding:utf-8 -*-
# 脚本用途：算出所有人的kappa 和 第一个人和所有人的kappa默认第一个人是 优质用户
# 脚本使用方法：
# get**.py  优秀用户文件 其他用户文件。。。。
import sys

reload(sys)
sys.setdefaultencoding("utf-8")

# 要处理的文件
#user_str="2,2,2,3,3,3,3,2,4,4,5,4,3,3,2,3,4,3,3,3,4,4,4,3,3,4,4,4,4,4,3,3,3,3,4,3,4,4,3,4,4,3,3,4,4,4,3,3,5,5,5,5,4,4,4,3,3,4,4,3,4,3,4,4,5,4,4,4,4,3,4,3,3,3,4,3,4,4,4,4,"
user_str = sys.argv[1]

# 平均值文件(用户1)
#avg_file = sys.argv[1]
avglist = [2.074074074,1.777777778,1.888888889,3.111111111,3.222222222,2.666666667,2.333333333,2.518518519,3.592592593,3.444444444,4.62962963,3.740740741,3.37037037,3.518518519,1.925925926,2.888888889,3.592592593,3.592592593,3.555555556,3.777777778,3.888888889,4.074074074,4.074074074,3.407407407,3.222222222,3.814814815,3.962962963,4.037037037,3.333333333,2.37037037,2.296296296,2.185185185,3.518518519,3.222222222,2.518518519,2.444444444,4.296296296,3.962962963,3.259259259,4.296296296,3.222222222,2.111111111,2.777777778,3,3.296296296,3.518518519,2.666666667,3.259259259,4.62962963,4.259259259,3.555555556,3.666666667,3.37037037,3.703703704,3.851851852,2.407407407,2.592592593,3.111111111,3.296296296,1.777777778,3.333333333,2.111111111,3,3.518518519,2.925925926,3.074074074,4.037037037,2.777777778,3.666666667,1.814814815,3,1.888888889,2.740740741,2.37037037,3.37037037,3.111111111,2.851851852,2.518518519,2.740740741,2.666666667]

# 用户原始文件（用户2）
#user_file = sys.argv[2]
userlist = []

# 二维矩阵
matrix = [[0 for col in range(4)] for i in range(4)]

# 数据读取到list中
def initList(file1, file2):
	global userlist
	userlist = []
	
	for line in str(file2).split(','):
		line = line.strip()
		if line:
			userlist.append(float(line))


# 处理平均分为标准分
def avgFormat():
	global avglist
	global userlist
	for i in range(0, len(avglist)):
		num = avglist[i]
		if num < 2.499:
			avglist[i] = 1
		elif num > 2.499 and num < 3.499:
			avglist[i] = 2
		elif num > 3.499 :
			avglist[i] = 3
		else:
			print 'num is error! ', num
			
	for i in range(0, len(userlist)):
		num = userlist[i]
		if num < 2.499:
			userlist[i] = 1
		elif num > 2.499 and num < 3.499:
			userlist[i] = 2
		elif num > 3.499 :
			userlist[i] = 3
		else:
			print 'num is error! ', num
	#print avglist, userlist

# 输出，调试用
def printlist(listname):
	for l in listname:
		print l

# 计算矩阵
def getMatrix():
	num1 = len(avglist)
	num2 = len(userlist)
	if num1 != num2:
		print 'two list num is not same!'
		return
	
	global matrix
	matrix = [[0 for col in range(4)] for i in range(4)]
	
	for i in range(0, num1):
		x = int(avglist[i])
		y = int(userlist[i])
		matrix[x][y] = matrix[x][y] + 1

# 输出矩阵
def printmatrix():
	#print '\nmatrix is:' 
	for num in range(1, 4):
		print matrix[num][1], matrix[num][2],matrix[num][3]
	#print '\n'

# 得到kappa值
def getkappa():
	# 对角线之和
	dsum = 0.0
	# 总数
	allsum = float(len(avglist))
	
	global matrix
	
	# 计算对角线的和
	for i in range(1, 4):
		dsum = dsum + matrix[i][i]
 
	
	#print dsum
	#print 'diagonal sum is :', dsum
	p0 = float(dsum)/allsum
	#print 'p0 is :', p0 , '\n'
	
	# 计算a1*b1+a2*b2+...ac*bc的和（a1 等于 matrix[1][x]的和  b1等于matrix[x][1]的和）
	a = 0
	al = []
	b = 0
	bl = []
	for j in range(1, 4):
		a = 0
		b = 0
		for k in range(1, 4):
			a = a + matrix[j][k]
			b = b + matrix[k][j]
		al.append(a)
		bl.append(b)
	
	#print 'a list is ', al
	#print 'b list is ', bl
	
	tmpsum = 0
	for l in range (0, 3):
		tmpsum = tmpsum + al[l]*bl[l]
	#print 'pe fenzi sum is: ', tmpsum 
	
	pe = float(tmpsum)/float(allsum*allsum)
	#print 'pe is: ',pe , '\n'
	
	kappa = (p0-pe)/(1-pe)
	#print 'kappa is : ', kappa
	return kappa
	
def gettwokappa(file_one, file_two):
	initList(file_one, file_two)
	avgFormat()
	#printlist(userlist)
	getMatrix()
	#printmatrix()
	return getkappa()



kapp = gettwokappa(avglist, user_str)
print kapp

