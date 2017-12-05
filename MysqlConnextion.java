/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mysqlconnextion;

import java.sql.*;

/**
 *
 * @author onur
 */
public class MysqlConnextion {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws ClassNotFoundException, InstantiationException, IllegalAccessException {
        Class.forName("com.mysql.jdbc.Driver").newInstance();
        String url = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/onur_kulak";
        try {
            Connection con = DriverManager.getConnection(url, "onur.kulak", "onurcs353");
            Statement stmt = con.createStatement();
            stmt.executeUpdate("DROP TABLE IF EXISTS apply;");
            stmt.executeUpdate("DROP TABLE IF EXISTS student;");
            stmt.executeUpdate("DROP TABLE IF EXISTS company;");
            
            stmt.executeUpdate("CREATE TABLE student"
                    + "(sid CHAR(12) , sname VARCHAR(50),"
                    + "bdate DATE, address VARCHAR(50), scity VARCHAR(20),"
                    + "year CHAR(20), gpa FLOAT, nationality VARCHAR(20),"
                    + " PRIMARY KEY(sid) )ENGINE=InnoDB;");
            stmt.executeUpdate("CREATE TABLE company"
                    + "(cid CHAR(8) , cname VARCHAR(20), quota INT,"
                    + " PRIMARY KEY(cid) )ENGINE=InnoDB;");
            

            stmt.executeUpdate("INSERT INTO student "
                    + "VALUES('21000001','Ayse',STR_TO_DATE('10.05.1995', '%d.%m.%Y'),'Tunali','Ankara','senior',2.75,'TC'),"
                    + "('21000002','Ali',STR_TO_DATE('12.09.1997', '%d.%m.%Y'),'Nisantasi','Istanbul','junior',3.44,'TC'),"
                    + "('21000003','Veli',STR_TO_DATE('25.10.1998', '%d.%m.%Y'),'Nisantasi','Istanbul','freshman',2.36,'TC'),"
                    + "('21000004','John',STR_TO_DATE('15.01.1999', '%d.%m.%Y'),'Windy','Chicago','freshman',2.55,'US');");
            stmt.executeUpdate("INSERT INTO company "
                    + "VALUES('C101','tubitak',2),"
                    + "('C102','aselsan',5),"
                    + "('C103','havelsan',3),"
                    + "('C104','microsoft',5),"
                    + "('C105','merkez bankasi',3),"
                    + "('C106','tai',4),"
                    + "('C107','milsoft',2);");
            stmt.executeUpdate("CREATE TABLE apply"
                    + "(sid CHAR(12) ,cid CHAR(8) ,"
                    + " PRIMARY KEY(sid,cid),"
                    +"FOREIGN KEY(cid) REFERENCES company(cid), FOREIGN KEY(sid) REFERENCES student(sid)"
                    +")ENGINE=InnoDB;");
            stmt.executeUpdate("INSERT INTO apply "
                    + "VALUES ('21000001','C101'),"
                    + "('21000001','C102'),"
                    + "('21000001','C103'),"
                    + "('21000002','C101'),"
                    + "('21000002','C105'),"
                    + "('21000003','C104'),"
                    + "('21000003','C105'),"
                    + "('21000004','C107');");
            stmt.executeQuery("SELECT * FROM student;");
        } catch (SQLException except) {
            System.out.println(except.getMessage());
        }
    }
}