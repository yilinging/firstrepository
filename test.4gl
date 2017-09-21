DATABASE ds

DEFINE 
	counter, number,i INT,
	ipadata RECORD LIKE ipa_file.*,
	usecursor VARCHAR(1),
	ipamat CHAR(30),
	ipabin CHAR(30),

	 myval varchar(20),
	 myval2 varchar(20),
	 var_fd4  INT

------------------------------------------------

MAIN
	INITIALIZE ipadata.* TO NULL
	LET usecursor = 'N'
	CALL prog_init()
		LET myval=ARG_VAL(1)
	LET myval2=ARG_VAL(2)


	OPTIONS		
		MESSAGE LINE    LAST,
		INPUT NO WRAP
	OPEN WINDOW w1 AT 5,5
		WITH FORM "/home/yiling/test/test"
		ATTRIBUTE(BORDER)	
	OPEN WINDOW w2 AT 5,5
		WITH FORM "/home/yiling/test/test2"
		ATTRIBUTE(BORDER)
	CURRENT WINDOW IS w1
	CALL main_menu()
END MAIN

------------------------------------------------

FUNCTION prog_init()
	OPTIONS
		INPUT WRAP 
END FUNCTION

------------------------------------------------

FUNCTION main_menu()

	MENU "Main Menu"
#		BEFORE MENU
#			HIDE OPTION ALL
#			SHOW OPTION "Query", "Exit"
#			COMMAND "Query" "Show another function"
#				SHOW OPTION "Next", "Previous", "Show", "Hide"
			COMMAND "ShowDB" "Show Database"
				CALL finddb_main()
			COMMAND "Show" "Show 9*9 table"
				CALL value()
			COMMAND "Hide" "Hide function"
				HIDE OPTION ALL
				SHOW OPTION "Exit"
			COMMAND "Exit" "Exit"
				EXIT PROGRAM
	END MENU
END FUNCTION
------------------------------------------------

FUNCTION dummy()
	ERROR "Funciton no finished"
END FUNCTION

------------------------------------------------

FUNCTION value()
	FOR counter=1 TO 9 STEP 1
		FOR number=1 TO 9 STEP 1
			LET i=counter*number
			DISPLAY counter, "*", number, "=",i  AT counter, number
		END FOR
	END FOR
END FUNCTION 

------------------------------------------------

FUNCTION finddb_main()
	MENU "DB Menu"
		COMMAND "First" "First data"
			CALL firstdata()
		COMMAND "Next" "Next data"
			CALL nextdata()
		COMMAND "Previous" "Previou data"
			CALL previousdata()
		COMMAND "Menu" "Back to main menu"
#			IF usecursor='Y' then
#				LET usecursor='N'
#				CLOSE mycursor
#			END IF
			CALL main_menu()
	END MENU
END FUNCTION

------------------------------------------------

FUNCTION firstdata()
	DEFINE
		ipamat CHAR(30),
		ipabin CHAR(30)

	DECLARE mycursor SCROLL CURSOR FOR              
	    SELECT *
	     FROM ipa_file
	OPEN mycursor
	Let usecursor = 'Y'
	FETCH  FIRST mycursor into ipadata.*
	IF SQLCA.SQLCODE = NOTFOUND THEN
#	 	ERROR "No rows found."
#	 	RETURN FALSE
		MESSAGE "Database Error",SQLCA.sqlcode
	ELSE 
		DISPLAY ipadata.ipamat,ipadata.ipabin TO ipamat,ipabin
#		RETURN TRUE
	END IF
END FUNCTION

------------------------------------------------

FUNCTION nextdata()
	MESSAGE ""
	IF usecursor = 'Y' THEN
		FETCH NEXT  mycursor INTO ipadata.*

		IF SQLCA.SQLCODE THEN
			MESSAGE "Database error",SQLCA.sqlcode
		ELSE	
			DISPLAY ipadata.ipamat,ipadata.ipabin TO ipamat,ipabin
		END IF
	ELSE
		message "Cursor not open"
	END IF

END FUNCTION

------------------------------------------------

FUNCTION previousdata()
	MESSAGE ""
		IF usecursor = 'Y' THEN
			FETCH PREVIOUS  mycursor INTO ipadata.*

			IF SQLCA.SQLCODE THEN
				MESSAGE "Database error",SQLCA.sqlcode
			ELSE	
				DISPLAY ipadata.ipamat,ipadata.ipabin TO ipamat,ipabin
			END IF
		ELSE
			message "Cursor not open"
		END IF

END FUNCTION

------------------------------------------------
