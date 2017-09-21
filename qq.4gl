DATABASE lpn

DEFINE
	 m_ios RECORD LIKE abi_file.*,
	 usecursor VARCHAR(1),
	 myval varchar(20),
	 myval2 varchar(20),
	 gint  INT,
	 myarr ARRAY[10] OF RECORD
	 	val        varchar(20)
	 END RECORD,
	 myarr2 ARRAY[10] OF RECORD
	 	val       varchar(20)
	 END RECORD


MAIN

	
	INITIALIZE m_ios.* TO NULL
	LET usecursor = 'N'
	LET myval=ARG_VAL(1)
	LET myval2=ARG_VAL(2)

	OPTIONS		
		MESSAGE LINE    LAST,
		INPUT NO WRAP
	OPEN WINDOW kkk_w AT 3,4 
		WITH FORM "/home/2140621/elangl/4gl/qq"
		ATTRIBUTE(BORDER)	


	CALL main_menu()

	
END MAIN






------------------------------------------------------------------

FUNCTION main_menu()
	
	DEFINE
		aas CHAR(20),
		aas2 CHAR(20),
		i smallint,
		aa char(20)
	
	CLEAR FORM
	MENU "笨蛋的4GL"
		COMMAND "算算看" "笨蛋算算看"
			CALL Caculate()
		COMMAND "看DB" "笨蛋看DB"
			CALL finddb_main()
		COMMAND "訊息" "訊息"
			LET myarr[1].val="A"
			LET myarr[2].val="B"
            MESSAGE  "這是一個訊息",usecursor,myval,myval2,"ARRAY",myarr[1].val,myarr[2].val
        COMMAND "產生檔案" "產生一個名叫aa.csv"
            prompt "print what?" for aas           	
            prompt "print what ahain?" for aas2         
        	start report aaa to "/home/2140621/elangl/4gl/kkk.csv"
				output to report aaa(aas,aas2)
			finish report aaa
		 	MESSAGE  "檔案已產生"		
		COMMAND "恩恩" ""
				FOR i=1 TO 10
					MESSAGE "OHOH",i
				end for	
		#COMMAND "Reports" "Enter reports"
		#	CALL dummy()
		COMMAND "關閉程式" "關閉程式"
			EXIT PROGRAM
	END MENU
END FUNCTION




------------------------------------------------------------------
FUNCTION Caculate()
	DEFINE
		var1 CHAR(20),
		var2 CHAR(20),
		resultd CHAR(40),
		exit_loop CHAR(1)

	CLEAR FORM
	
	
	#INPUT  var1,var2 from s_var.*
	INPUT by name var1,var2 
		after field var2
			let resultd=var1 CLIPPED,var2 CLIPPED
	end input

	DISPLAY resultd TO result
	DISPLAY "" TO var1
	DISPLAY "" TO var2
		
END FUNCTION



------------------------------------------------------------------

FUNCTION finddb()
DEFINE
		var1 VARCHAR(20),
		var2 VARCHAR(20),
		resultd VARCHAR(40),
		exit_loop VARCHAR(1)

CLEAR FORM		
MESSAGE ""



DECLARE mycursor scroll CURSOR FOR            
    SELECT *
    FROM abi_file  
    
open mycursor
LET usecursor = 'Y'
fetch first mycursor into m_ios.*
IF SQLCA.sqlcode THEN
	MESSAGE "資料庫異常",SQLCA.sqlcode
else
	DISPLAY SQLCA.SQLCODE,m_ios.abi01 TO var2,result
end if
END FUNCTION
------------------------------------------------------------------

function finddb_main()
MENU "Main Menu:"
		COMMAND "重新查詢" "重新查詢"
			CALL finddb()
		COMMAND "下一筆" "下一筆阿笨蛋"
			CALL nextd()
		COMMAND "上一筆" "上一筆阿笨蛋"
			CALL pervd()
		COMMAND "回主選單" "回主選單阿笨蛋"	
			if usecursor='Y' then
				LET usecursor='N'
				close mycursor
			end if	
			CALL main_menu()	
			
END MENU
END FUNCTION





------------------------------------------------------------------
function nextd()
MESSAGE ""
if usecursor='Y' then
	FETCH NEXT  mycursor INTO m_ios.*

	IF SQLCA.sqlcode THEN
		MESSAGE "資料庫異常",SQLCA.sqlcode
	else	
		DISPLAY SQLCA.SQLCODE,m_ios.abi01 TO var2,result
	end if
else
	message "你的游標還沒開阿"
end if

END function

------------------------------------------------------------------
function pervd()
MESSAGE ""
if usecursor='Y' then
	FETCH PREVIOUS  mycursor INTO m_ios.*
	IF SQLCA.sqlcode THEN
		MESSAGE "資料庫異常",SQLCA.sqlcode
	else	
		DISPLAY SQLCA.SQLCODE,m_ios.abi01 TO var2,result
	end if
else
	message "你的游標還沒開阿"
end if

END function



------------------------------------------------------------------

FUNCTION dummy()
	ERROR "Funciton no finished"
END FUNCTION

------------------------------------------------------------------

FUNCTION stock_menu()
	ERROR "Funciton no finished"
END FUNCTION

----------------------------------------------------------------------

report aaa(gg,gg2)
DEFINE
	gg varchar(30),
	gg2 varchar(30)


OUTPUT TOP    MARGIN 0
          LEFT   MARGIN 0
          BOTTOM MARGIN 0        

FORMAT	
	FIRST PAGE HEADER	
	PRINT COLUMN 01,gg
	PRINT COLUMN 01,gg2	
	PRINT COLUMN 20,"哈哈哈嘿嘿"
	ON every row
	PRINT COLUMN 01,"END"
end report