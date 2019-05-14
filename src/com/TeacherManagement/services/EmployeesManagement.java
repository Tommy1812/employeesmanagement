package com.TeacherManagement.services;

import java.io.File;
import java.net.URISyntaxException;
import java.nio.ByteBuffer;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.TimeZone;

import javax.json.bind.annotation.JsonbDateFormat;
import javax.swing.text.DateFormatter;
import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
@Path("/EmployeesManagement")
public class EmployeesManagement {
	
	/* All user functions */
	
	/* 1. Login */
	@POST
	@Path("/login/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public String isAdmin(@FormParam("username") String username, @FormParam("password") String password) throws URISyntaxException
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();

			//rs = stmt.executeQuery("SELECT * FROM account");
			//String query = "SELECT * FROM account WHERE USERNAME = '" + username + "' AND ACTIVE = '1'";
			
			String query = "SELECT * FROM account WHERE USERNAME = '" + username + "' AND PASSWORD = '" + password + "' AND ACTIVE = '1'";
			rs = stmt.executeQuery(query);
			while(rs.next()) {
				String role = rs.getString("ROLE");
				if(role.equals("1")) {
					return "1";
				}
				else if(role.equals("0")) {
					return "0";
				}
			}
			logging(username);
			return "99";
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return "0";
	}
	
	
	
	/* 2. Logging  -> Return start time */
	private boolean logging(String username) {
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			
			String date = getCurrentDate1();
			String time = getCurrentTime1();
			stmt.executeUpdate("INSERT INTO `logging`(`ACCOUNTLOGGER`, `DATE`, `TIMESTART`, `TIMEOUT`) VALUES ('" + username + "','"+ date +"','" + time + "','')");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	
	
	private String getCurrentTime1() {
		return java.time.LocalTime.now().toString();
	}
	
	private String getCurrentDate1() {
		long millis=System.currentTimeMillis();  
		java.sql.Date date=new java.sql.Date(millis);
		return date.toString();
	}
	
	/* 3. Logout */
	@POST
	@Path("/logout/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	//public void logout(@FormParam("username") String username, @FormParam("date") String date, @FormParam("timestart") String timestart )
	public boolean logout(@FormParam("username") String username)
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();

			String time = getCurrentTime1();			
		    /*Sua cau truy van*/
			//stmt.executeUpdate("UPDATE `teacherdatabase`.`logging` SET `TIMEOUT` = '" + time + "' WHERE `logging`.`ACCOUNTLOGGER` = '" + username + "' AND `logging`.`DATE` = '" + date +"' AND `logging`.`TIMESTART` = '" + timestart +"';");
			stmt.executeUpdate("UPDATE `logging`  SET `TIMEOUT`='" + time + "' WHERE ACCOUNTLOGGER = '" + username +"' ORDER BY `DATE` DESC, `TIMESTART` DESC LIMIT 1"); // Duy : co the where timeout null
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("/ViewAnnouncement/") 
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)     
	@Produces(MediaType.APPLICATION_JSON)
	public Announcement ViewAnnoucement(@FormParam("TITLE") String TITLE)   //Duy : return ve title+content , co nen tao doi tuong thong bao ?
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `announcement` WHERE  `TITLE` = '" + TITLE + "'");

			String id = "";
			String content= "";
			String idAdmin= "";
			 
			Announcement ann = new Announcement();
			while(rs.next()) {				
				Date datepost = new Date();
				id       = rs.getString("ID");
				content  = rs.getString("CONTENT");
				idAdmin  = rs.getString("IDADMIN");
				//datepost = new SimpleDateFormat("dd/MM/yyyy").parse(rs.getString("DATEPOS"));	
				
				 /* DOB */
				 datepost = rs.getDate("DATEPOST");
				 String datepostStr = datepost.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 datepost = utcFormat.parse(datepostStr);
				 /*      */
				 
				ann.setId(id);
				ann.setContent(content);
				ann.setIdadmin(idAdmin);
				ann.setTitle(TITLE);
				ann.setDatepost(datepost);
			}
			return ann;     //Duy: return Object ?
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		
		return null;
	}
	 
	 /* End all user functions*/
	
	/*********Teacher Functions**********/
	
	/*UpdatePersonalInformation*/
	@POST
	@Path("/UpdatePersonalInfomation/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
	@Produces(MediaType.APPLICATION_JSON)
	public boolean UpdatePersonalInfomation(@FormParam("ID") String ID
			, @FormParam("EMPLOYEENAME") String EMPLOYEENAME
			, @FormParam("DOB") String DOB
			, @FormParam("ROLE_INPUT") String ROLE
			, @FormParam("GENDER") String GENDER
			, @FormParam("PHONENUMBER") String PHONENUMBER
			, @FormParam("COUNTRY") String COUNTRY
			, @FormParam("EMAIL") String EMAIL
			, @FormParam("ADDRESS") String ADDRESS
			, @FormParam("RELIGION") String RELIGION
			, @FormParam("PASSWORD") String PASSWORD)   
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			String updateStatement = "UPDATE `employee` SET `NAME`='"+EMPLOYEENAME+"',`DOB`='"+DOB+"', `ROLE`='"+ ROLE + "', `GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"' WHERE ID = '"+ID+"'  ";
			stmt.executeUpdate(updateStatement);
			
			String updateAccount = "UPDATE `account` SET `PASSWORD`=MD5('" + ID + PASSWORD +"') WHERE `USERNAME`= '" + ID +"'";
			//rs = stmt.executeQuery("UPDATE `account` SET PASSWORD`='"+PASSWORD+"' WHERE USERNAME = '"+ID+"'");
			stmt.executeUpdate(updateAccount);
			
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return true;
	}
	
	
	/*SearchTeacher*/
	
	/*ViewPersonalSalary*/
	@POST
	@Path("Employee/ViewSalary/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Salary> ViewSalary(@FormParam("ID") String ID)   
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Salary> lstSalary = new ArrayList<Salary>();
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `salary` WHERE `EMPLOYEE_ID`= '"+ID+"' ORDER BY YEAR , MONTH ");
			
			while (rs.next())
			{
				String id =		    rs.getString("ID");
				String month = 		rs.getString("MONTH");
				Integer year =		rs.getInt("YEAR");
				Double total =   rs.getDouble("TOTAL");
				Salary salary = new Salary();
				salary.setId(id);
				salary.setMonth(month);
				salary.setYear(year);
				salary.setTotal(total);
			
				lstSalary.add(salary);
			}
			return lstSalary;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return lstSalary ;
	}
	
	/*********End Teacher Functions***********/
	
	
	/*********All Admin Function**********/
	
	/*Teacher - Add*/
	@POST
	@Path("Admin/AddEmployee/") //TeacherManagement/AddTeacher/
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean AddEmployee(
			@FormParam("EMPLOYEENAME") String EMPLOYEENAME, 
			@FormParam("DOB") String DOB, 
			@FormParam("IDENTIFYCARDNUMBER") String IDENTIFYCARDNUMBER,
			@FormParam("GENDER") String GENDER, 
			@FormParam("PHONENUMBER") String PHONENUMBER, 
			@FormParam("COUNTRY") String COUNTRY,
			@FormParam("EMAIL") String EMAIL, @FormParam("ADDRESS") String ADDRESS, 
			@FormParam("RELIGION") String RELIGION,
			@FormParam("ROLE") String ROLE)
	{
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			
			String ID = Auto_Increment_ID();
			
			java.util.Date dt = new java.util.Date();
			java.text.SimpleDateFormat sdf = 
			     new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			String currentTime = sdf.format(dt);
			
			
			stmt = conn.createStatement();
			// insert account
			//stmt.executeUpdate("INSERT INTO `account` (`USERNAME`, `PASSWORD`, `DATECREATED`, `ROLE`, `ACTIVE`) VALUES ('"+ID+"','123456','"+currentTime+"',b'0', b'1')");
			String insertAccount = "INSERT INTO `account` (`USERNAME`, `PASSWORD`, `DATECREATED`, `ROLE`, `ACTIVE`) VALUES ('"+ID+"',MD5('"+ ID + "123456" + "'),'"+currentTime+"',b'0', b'1')";
			stmt.executeUpdate(insertAccount);
			
			stmt.executeUpdate("INSERT INTO `employee` (`ID`, `NAME`, `DOB`, `IDENTIFYCARDNUMBER`, `GENDER`, `PHONENUMBER`, `COUNTRY`, `EMAIL`, `ADDRESS`, `RELIGION`, `STATUS`, `ROLE`) VALUES\r\n" + 
					"('"+ID+"', '"+EMPLOYEENAME+"', '"+DOB+"', '"+IDENTIFYCARDNUMBER+"', '"+GENDER+"', '"+PHONENUMBER+"', '"+COUNTRY+"', '"+EMAIL+"', '"+ADDRESS+"', '"+RELIGION+"', b'1', '"+ROLE+"')");
			
			String scheduleID = "SC" + ID.substring(2);
			stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `MONTH`, `YEAR`, `ID_Employee`) VALUES ('"+ scheduleID +"',0,0,'0','0','0000','"+ ID + "')");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Admin - update*/
	@POST
	@Path("Admin/UpdateAdmin/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean UpdateAdminInformation(@FormParam("ID") String ID,
			@FormParam("NAME") String NAME, 
			@FormParam("DOB") String DOB, 
			@FormParam("IDENTIFYCARDNUMBER") String IDENTIFYCARDNUMBER, 
			@FormParam("GENDER") String GENDER, 
			@FormParam("PHONENUMBER") String PHONENUMBER, 
			@FormParam("COUNTRY") String COUNTRY, 
			@FormParam("EMAIL") String EMAIL, 
			@FormParam("ADDRESS") String ADDRESS, 
			@FormParam("RELIGION") String RELIGION,
			@FormParam("STATUS") String STATUS)
	{
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();

			String UpdatesqlStatement = "UPDATE `admin` SET `NAME`='"+NAME+
					"',`DOB`='"+DOB+
					"',`IDENTIFYCARDNUMBER`='"+IDENTIFYCARDNUMBER+
					"',`GENDER`='"+GENDER+
					"',`PHONENUMBER`='"+PHONENUMBER+
					"',`COUNTRY`='"+COUNTRY+
					"',`EMAIL`='"+EMAIL+
					"',`ADDRESS`='"+ADDRESS+
					"',`RELIGION`='"+RELIGION+
					"',`STATUS`='"+STATUS+
					"' WHERE ID = '"+ID+"'";
			stmt.executeUpdate(UpdatesqlStatement);
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Admin - Delete*/
	@POST
	@Path("Admin/DeleteEmployee/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	
	public boolean DeleteEmployee(@FormParam("ID") String ID)
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			// delete teacher
			stmt.executeUpdate("UPDATE `employee` SET `STATUS`= 0 WHERE ID ='"+ID+"'");
			String deleteAccount = "UPDATE `account` SET `ACTIVE`= 0 WHERE `USERNAME`= '" + ID + "'";
			
			stmt.executeUpdate(deleteAccount);
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Admin - update*/
	@POST
	@Path("Admin/UpdateEmployeeInfo/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED + "; charset=utf-8")
	@Produces(MediaType.APPLICATION_JSON + "; charset=utf-8")
	
	public boolean UpdateEmployee_Admin(@FormParam("ID") String ID,
			@FormParam("EMPLOYEENAME") String EMPLOYEENAME, 
			@FormParam("DOB") String DOB, 
			@FormParam("IDENTIFYCARDNUMBER") String IDENTIFYCARDNUMBER, 
			@FormParam("GENDER") String GENDER, 
			@FormParam("PHONENUMBER") String PHONENUMBER, 
			@FormParam("COUNTRY") String COUNTRY, 
			@FormParam("EMAIL") String EMAIL, 
			@FormParam("ADDRESS") String ADDRESS, 
			@FormParam("RELIGION") String RELIGION,
			@FormParam("STATUS") String STATUS, 
			@FormParam("ROLE") String ROLE)
	{

		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
		
			stmt = conn.createStatement();
			// Update teacher _ Admin ( khong update ID)
			
			stmt.executeUpdate("UPDATE `employee` SET `NAME`='"+EMPLOYEENAME+"',`DOB`='"+DOB+"',`IDENTIFYCARDNUMBER`='"+IDENTIFYCARDNUMBER+"',`GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"',`STATUS`="+STATUS+",`ROLE`='"+ROLE+"' WHERE ID = '"+ID+"'");
			
			String sqlUpdateAccount = "UPDATE `account` SET `ACTIVE`= " + STATUS + " WHERE `USERNAME`= '" + ID + "'";
			stmt.executeUpdate(sqlUpdateAccount);
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Admin - ViewInformation*/
	@POST
	@Path("/ViewEmployeeInfomation/")  // GetInfoTeacher
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
	@Produces(MediaType.APPLICATION_JSON)
	@JsonbDateFormat
	public Employee ViewEmployeeInfomation(@FormParam("username") String ID)   
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `employee` WHERE ID = '"+ID+"'"); 
			Employee employee = new Employee();
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 /* DOB */
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 /*      */
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 String role =	     rs.getString("ROLE");
				 
				 employee.setId(id);
				 employee.setName(name);
				 employee.setDOB(DOB);
				 employee.setIdentifycardnumber(identifycardnumber);
				 employee.setGender(gender);
				 employee.setPhonenumber(phonenumber);
				 employee.setCountry(country);
				 employee.setEmail(email);
				 employee.setAddress(address);
				 employee.setReligion(religion);
				 employee.setStatus(status);
				 employee.setRole(role);
				
			}
			return employee;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	/*ADMIN - ViewInformation*/
	@POST
	@Path("Admin/ViewAdminInfomation/")  // GetInfoTeacher
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
	@Produces(MediaType.APPLICATION_JSON)
	public Admin ViewAdminInfomation(@FormParam("username") String ID)   
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `admin` WHERE ID = '"+ID+"'"); 
			Admin admin = new Admin();
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 
				 admin.setId(id);
				 admin.setName(name);
				 admin.setDOB(DOB);
				 admin.setIdentifycardnumber(identifycardnumber);
				 admin.setGender(gender);
				 admin.setPhonenumber(phonenumber);
				 admin.setCountry(country);
				 admin.setEmail(email);
				 admin.setAddress(address);
				 admin.setReligion(religion);
				 admin.setStatus(status);				
			}
			return admin;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	/*Admin - GetAllUserInformation*/
	@POST
	@Path("Admin/GetListEmployee/")  //Admin/GetListTeacher/
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Employee> GetListEmployee() 
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Employee> ArrayEmployee = new ArrayList<Employee>();
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `employee`");
			
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 /* DOB */
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 /*      */
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 String role =	     rs.getString("ROLE");
				 
				 
				 Employee employee = new Employee();
				 employee.setId(id);
				 employee.setName(name);
				 employee.setDOB(DOB);
				 employee.setIdentifycardnumber(identifycardnumber);
				 employee.setGender(gender);
				 employee.setPhonenumber(phonenumber);
				 employee.setCountry(country);
				 employee.setEmail(email);
				 employee.setAddress(address);
				 employee.setReligion(religion);
				 employee.setStatus(status);
				 employee.setRole(role);

				 ArrayEmployee.add(employee);
				 }
			return ArrayEmployee;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return ArrayEmployee ;
	}
	
	
	/* Announcement - Upload*/
	@POST
	@Path("Admin/UploadAnnoucement/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean UploadAnnoucement(@FormParam("TITLE") String TITLE,
			@FormParam("CONTENT") String CONTENT, @FormParam("IDADMIN") String IDADMIN)
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		String ID = Auto_Increment_ID_Announcement();
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			
			String date = getCurrentDate1();
			stmt.executeUpdate("INSERT INTO `announcement` (`ID`, `TITLE`, `CONTENT`, `IDADMIN`, `DATEPOST`) VALUES\r\n" + 
					"('"+ID+"','"+TITLE+"', '"+CONTENT+"', '"+IDADMIN+"', '"+date+"')"); 
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("Employee/GetListAnnouncement/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Announcement> GetListAnnouncement_Title() 
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Announcement> ArrayAnnouncement = new ArrayList<Announcement>();
		try {
			//.mysql.jdbc.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT DISTINCT `TITLE` ,`DATEPOST` FROM `announcement` ORDER BY `DATEPOST`DESC ");
			
			while (rs.next())
			{
				String title = rs.getString("TITLE");
				 /* DOB */
				 Date datepost = rs.getDate("DATEPOST");
				 String datepostStr = datepost.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 datepost = utcFormat.parse(datepostStr);
				 /*      */
				 
				Announcement announcement = new Announcement();
				announcement.setTitle(title);

				announcement.setDatepost(datepost);
				
				ArrayAnnouncement.add(announcement);
			}
			return ArrayAnnouncement;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return ArrayAnnouncement ;
	}
	
	/*********End All Admin Function*********/
	
	public String Auto_Increment_ID ()
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			int count = 0;
			rs = stmt.executeQuery("SELECT * FROM employee");
			while (rs.next())
			{
				count+=1;
			}
			count+=1;
			String result = "";
			if(count < 10) {
				result = "GV00" + count;
			}
			else if(count >= 10 && count <100) {
				result = "GV0" + count;
			}
			else {
				result = "GV" + count;
			}
			return result;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return "GV000";
	}
	
	
	public String Auto_Increment_ID_Announcement ()
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			int count = 0;
			rs = stmt.executeQuery("SELECT * FROM announcement");
			while (rs.next())
			{
				count+=1;
			}
			count+=1;
			String result = "";
			if(count < 10) {
				result = "TB00" + count;
			}
			else if(count >= 10 && count <100) {
				result = "TB0" + count;
			}
			else {
				result = "TB" + count;
			}
			return result;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return "TB000";
	}
	
	
	
	
	@POST
	@Path("Employee/viewSchedule/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Schedule> getListSchedule(
			@FormParam("employeeid") String employeeid,
			@FormParam("day") int day,
			@FormParam("year") String year,
			@FormParam("month") String month)
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Schedule> ArraySchedule = new ArrayList<Schedule>();
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jdbc:mysql://localhost:3306/"
			 		+ "teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			//rs = stmt.executeQuery("SELECT DISTINCT `TITLE` ,`DATEPOST` FROM `announcement` ORDER BY `DATEPOST`DESC ");
			String query = "SELECT * FROM `schedule` WHERE ID_Employee = '"
			+ employeeid +"' AND YEAR = '"+year+"' AND DAY = '"+ day+"' AND MONTH = '"+month+"'";
			rs = stmt.executeQuery(query);
			while (rs.next())
			{
				Schedule schedule = new Schedule();
				String id = rs.getString("ID");
				int shift = rs.getInt("SHIFT");
				String[] time;
				time = convertShiftToTime(shift);
				String timeStart = time[0];
				String timeEnd = time[1];
				String location = rs.getString("LOCATION");
				schedule.setId(employeeid);
				schedule.setDay(day);
				schedule.setId(id);
				schedule.setLocation(location);
				schedule.setTimeEnd(timeEnd);
				schedule.setTimeStart(timeStart);
				schedule.setMonth(month);
				schedule.setYear(year);
				ArraySchedule.add(schedule);
			}
			return ArraySchedule;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	private String[] convertShiftToTime(int shift){
		String[] result = new String[2];
		if(shift == 1) {
			result[0] = "7:00";
			result[1] = "9:30";
		}
		else if (shift == 2) {
			result[0] = "9:30";
			result[1] = "12:00";
		}
		else if (shift == 3) {
			result[0] = "13:00";
			result[1] = "15:30";
		}
		else if (shift == 4) {
			result[0] = "15:30";
			result[1] = "18:00";
		}
		return result;
	}
	
	/*Schedule - Add*/
	@POST
	@Path("Admin/AddSchedule/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean AddSchedule(@FormParam("EmployeeID") String EmployeeID,
			@FormParam("Day") int Day,
			@FormParam("Shift") int Shift,
			@FormParam("Location") String Location,
			@FormParam("Month") String Month,
			@FormParam("Year") String Year
	)
	{
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			
			String scheduleID = "SC" + EmployeeID.substring(2);

			stmt = conn.createStatement();
			//String queryDelete = "DELETE FROM `schedule` WHERE 'SHIFT' = 0 AND 'DAY' = 0 AND ID='"+scheduleID+"'";
			String queryInsert = "INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `MONTH`, `YEAR`, `ID_Employee`) "
					+ "VALUES ('"+ scheduleID +"',"+ Day + ","+ Shift+ ",'"+ Location+ "','"
					+ Month+"','"+ Year+ "','"+ EmployeeID + "')";
			//stmt.executeUpdate(queryDelete);
			stmt.executeUpdate(queryInsert);
			//stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `ID_Employee`) VALUES ('"+ scheduleID +"',"+ Day + ", +"+ Shift+ "0,+'"+ Location+ "','"+ Semester+",'"+ Year+ "','"+ TeacherID + "')");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("Admin/getListSalary/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Salary> getListSalary() 
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Salary> ArraySalary = new ArrayList<Salary>();
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			//rs = stmt.executeQuery("SELECT DISTINCT `TITLE` ,`DATEPOST` FROM `announcement` ORDER BY `DATEPOST`DESC ");
			String query = "SELECT * FROM `salary` ORDER BY `ID` ASC, `YEAR` DESC, `MONTH`";		
			rs = stmt.executeQuery(query);
			
			
			while (rs.next())
			{
				Salary salary = new Salary();
				String id = rs.getString("ID");
				String month = rs.getString("MONTH");
				int year = rs.getInt("YEAR");
				double total = rs.getDouble("TOTAL");
				String EmployeeID = rs.getString("EMPLOYEE_ID");
				
				salary.setId(id);
				salary.setMonth(month);
				salary.setName("");
				salary.setYear(year);
				salary.setTotal(total);
				salary.setEmployeeID(EmployeeID);
				ArraySalary.add(salary);
			}
			
			return ArraySalary;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	/*Salary - Add*/
	@POST
	@Path("Admin/AddSalary/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean AddSalary(@FormParam("EmployeeID") String EmployeeID,
			@FormParam("Month") String Month,
			@FormParam("Year") int Year,
			@FormParam("Total") Double Total
	) {
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			
			String salaryID = "LB" + EmployeeID.substring(2);
			stmt = conn.createStatement();
			String queryInsert = "INSERT INTO `salary`(`ID`, `MONTH`, `YEAR`, `TOTAL`, `EMPLOYEE_ID`) VALUES "
					+ "('"+salaryID+"','"+Month+"',"+Year+","+Total.intValue()+",'"+EmployeeID+"')";
			stmt.executeUpdate(queryInsert);
			//stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `ID_Employee`) VALUES ('"+ scheduleID +"',"+ Day + ", +"+ Shift+ "0,+'"+ Location+ "','"+ Semester+",'"+ Year+ "','"+ TeacherID + "')");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("/getListEmployeeID/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<String> getListEmployeeID() {
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<String> lstID = new ArrayList<String>();
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			
			stmt = conn.createStatement();
			String querySelect = "SELECT ID FROM `employee` ORDER BY ID ASC";
			rs = stmt.executeQuery(querySelect);
			while (rs.next())
			{
				String ID = rs.getString("ID");
				lstID.add(ID);
			}
			return lstID;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	@POST
	@Path("filterEmployee/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Employee> FilterEmployee(@FormParam("Status") String Status) 
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Employee> ArrayEmployee = new ArrayList<Employee>();
		try {
			Class.forName("org.postgresql.Driver");
			//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
			//String connectuser = "soa";
			//String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `employee` WHERE STATUS = " + Status);
			
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 /* DOB */
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 /*      */
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 String role =	     rs.getString("ROLE");
				 
				 Employee employee = new Employee();
				 employee.setId(id);
				 employee.setName(name);
				 employee.setDOB(DOB);
				 employee.setIdentifycardnumber(identifycardnumber);
				 employee.setGender(gender);
				 employee.setPhonenumber(phonenumber);
				 employee.setCountry(country);
				 employee.setEmail(email);
				 employee.setAddress(address);
				 employee.setReligion(religion);
				 employee.setStatus(status);
				 employee.setRole(role);
				 
				 ArrayEmployee.add(employee);
			}
			return ArrayEmployee;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return ArrayEmployee;
	}
		
		@POST
		@Path("getYear/")  
		@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
		@Produces(MediaType.APPLICATION_JSON)
		public ArrayList<Integer> getYear() 
		{
			Connection conn = null;
			Statement stmt = null;
			ResultSet rs = null;
			ArrayList<Integer> ArrayYear = new ArrayList<Integer>();
			try {
				Class.forName("org.postgresql.Driver");
				//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
				//String connectuser = "soa";
				//String connectpass = "12345678";
				 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
				 String connectuser = "aefyphfpgkeelo";
				 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
				conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
				stmt = conn.createStatement();
				String query = "SELECT DISTINCT YEAR FROM `salary` ORDER BY `YEAR` DESC";
				rs = stmt.executeQuery(query);
				
				while (rs.next())
				{
					 Integer year = rs.getInt("YEAR");
					 ArrayYear.add(year);
				}
				return ArrayYear;
					
			} catch (Exception e) {
				e.printStackTrace();
			} finally {
				try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
				try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
				try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
			}
			return ArrayYear;
	}
	/*
	 * 
	 */
		@POST
		@Path("getMonth/")  
		@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
		@Produces(MediaType.APPLICATION_JSON)
		public ArrayList<Integer> getMonth() 
		{
			Connection conn = null;
			Statement stmt = null;
			ResultSet rs = null;
			ArrayList<Integer> ArrayMonth = new ArrayList<Integer>();
			try {
				Class.forName("org.postgresql.Driver");
				//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
				//String connectuser = "soa";
				//String connectpass = "12345678";
				 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
				 String connectuser = "aefyphfpgkeelo";
				 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
				conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
				stmt = conn.createStatement();
				String query = "SELECT DISTINCT MONTH FROM `salary` ORDER BY `MONTH` DESC";
				rs = stmt.executeQuery(query);
				
				while (rs.next())
				{
					 Integer month = rs.getInt("MONTH");
					 ArrayMonth.add(month);
				}
				return ArrayMonth;
					
			} catch (Exception e) {
				e.printStackTrace();
			} finally {
				try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
				try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
				try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
			}
			return ArrayMonth;
	}
		//*************
	@POST
	@Path("Admin/filterMonthYear/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Salary> getMonthTotal(@FormParam("id") String ID,@FormParam("Year") int Year) 
	{
			Connection conn = null;
			Statement stmt = null;
			ResultSet rs = null;
			ArrayList<Salary> ArraySalary = new ArrayList<Salary>();
			try {
				Class.forName("org.postgresql.Driver");
				//String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
				//String connectuser = "soa";
				//String connectpass = "12345678";
				 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
				 String connectuser = "aefyphfpgkeelo";
				 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
				conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
				stmt = conn.createStatement();
				String query = "SELECT MONTH, TOTAL FROM `salary` WHERE EMPLOYEE_ID = '" + ID + "' AND YEAR = " + Year;
				rs = stmt.executeQuery(query);
				
				while (rs.next())
				{
					Salary salary = new Salary();
					String month = rs.getString("MONTH");
					double total = rs.getDouble("TOTAL");
					
					salary.setMonth(month);
					salary.setTotal(total);
					ArraySalary.add(salary);
				}
				return ArraySalary;
					
			} catch (Exception e) {
				e.printStackTrace();
			} finally {
				try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
				try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
				try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
			}
			return ArraySalary;
	}

	@POST
	@Path("Admin/ImportCSV/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean ImportCSV(@FormParam("array") String arr)
	{
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			String connectuser = "aefyphfpgkeelo";
			String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			// process data
			String adjusted = arr.replaceAll("(?m)^[ \t]*\r?\n", "");
			List<String> items = Arrays.asList(adjusted.split("\n"));
			for(String s:items) {
				List<String> data = Arrays.asList(s.split(","));
				
				String ID = Auto_Increment_ID();
				
				java.util.Date dt = new java.util.Date();
				java.text.SimpleDateFormat sdf = 
				     new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
				String currentTime = sdf.format(dt);
				
				String EMPLOYEENAME = data.get(0).trim();
				String DOB = data.get(1).trim();
				String IDENTIFYCARDNUMBER = data.get(2).trim();
				String GENDER = data.get(3).trim();
				String PHONENUMBER = data.get(4).trim();
				String COUNTRY = data.get(5).trim();
				String EMAIL = data.get(6).trim();
				String ADDRESS = data.get(7).trim();
				String RELIGION = data.get(8).trim();
//				String ROLE = data.get(9).trim();
//				ROLE = ROLE.replace("<br />", "");
				String ROLE = data.get(9).trim();
				
				boolean isValidInput = isValidInSearch(IDENTIFYCARDNUMBER, EMAIL, PHONENUMBER);
				if(isValidInput) {
					// insert account
					String insertAccount = "INSERT INTO `account` (`USERNAME`, `PASSWORD`, `DATECREATED`,"
							+ " `ROLE`, `ACTIVE`) "
							+ "VALUES ('"+ID+"',MD5('"+ ID + "123456" + "'),'"+currentTime+"',b'0', b'1')";
					stmt.executeUpdate(insertAccount);
					
					// insert teacher
					String insertEmployee = "INSERT INTO `employee` (`ID`, `NAME`, `DOB`, `IDENTIFYCARDNUMBER`, "
							+ "`GENDER`, `PHONENUMBER`, `COUNTRY`, `EMAIL`, `ADDRESS`, `RELIGION`, `STATUS`, "
							+ "`ROLE`) VALUES\r\n" 
							+ "('"+ID+"', '"+EMPLOYEENAME+"', '"+DOB+"', '"+IDENTIFYCARDNUMBER+"', '"+GENDER+"', '"
							+ PHONENUMBER+"', '"+COUNTRY+"', '"+EMAIL+"', '"+ADDRESS+"', '"+RELIGION+"', b'1', '"
							+ ROLE+"')";
					stmt.executeUpdate(insertEmployee);
				}
				else {
					continue;
				}
			}
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("Admin/ImportCSVSalary/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean ImportCSVSalary(@FormParam("array") String arr)
	{
		Connection conn = null;
		Statement stmt = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			 String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			 String connectuser = "aefyphfpgkeelo";
			 String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			// process data
			String adjusted = arr.replaceAll("(?m)^[ \t]*\r?\n", "");
			List<String> items = Arrays.asList(adjusted.split("\n"));
			for(String s:items) {
				List<String> data = Arrays.asList(s.split(","));
				String EmployeeID = data.get(3).trim();
				String salaryID = "LB" + EmployeeID.substring(2);
				String Month = data.get(0).trim();
				String Year = data.get(1).trim();
				String Total = data.get(2).trim();
				stmt = conn.createStatement();
				String queryInsert = "INSERT INTO `salary`(`ID`, `MONTH`, `YEAR`, `TOTAL`, `EMPLOYEE_ID`) VALUES"
						+ " ('"+salaryID+"','"+Month+"',"+Year+","+Total+",'"+EmployeeID+"')";
				//stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `ID_Employee`) VALUES ('"+ scheduleID +"',"+ Day + ", +"+ Shift+ "0,+'"+ Location+ "','"+ Semester+",'"+ Year+ "','"+ TeacherID + "')");
				stmt.executeUpdate(queryInsert);
				
				}
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}

	private boolean isValidInSearch(String Identify, String Email,  String Phone) {
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("org.postgresql.Driver");
//			String connectURL = "jdbc:mysql://soaproject.cl9haf4nnyun.ap-southeast-1.rds.amazonaws.com:3306/teacher?useUnicode=true&characterEncoding=utf-8";
//			String connectuser = "soa";
//			String connectpass = "12345678";
			String connectURL = "jbdc:postgresql://ec2-79-125-4-72.eu-west-1.compute.amazonaws.com:5432/dela3st9res08v?sslmode=require";
			String connectuser = "aefyphfpgkeelo";
			String connectpass = "0d9d22b1aa2b758402f1006c32f7577f5e6c90ab798c2eb57d9d3f7900426830";
			conn = DriverManager.getConnection(connectURL, connectuser, connectpass);
			stmt = conn.createStatement();
			String query = "SELECT * FROM `employee` WHERE `IDENTIFYCARDNUMBER` = '"+ Identify 
					+"' OR `PHONENUMBER` = '" + Phone + "' OR `EMAIL` = '" + Email + "'";
			//rs = stmt.executeQuery("SELECT * FROM account WHERE ACTIVE = '1'");
			rs = stmt.executeQuery(query);
			while (rs.next())
			{
				return false;
			}
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return true;
	}
}