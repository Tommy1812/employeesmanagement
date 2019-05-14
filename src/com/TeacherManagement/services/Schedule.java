package com.TeacherManagement.services;

public class Schedule {
	public Schedule(String id, Integer day, String timeStart, String timeEnd, String location, String month,
			String year, String idemployee) {
		super();
		this.id = id;
		this.day = day;
		this.timeStart = timeStart;
		this.timeEnd = timeEnd;
		this.location = location;
		this.month = month;
		this.year = year;
		this.idemployee = idemployee;
	}
	public Schedule() {}
	private String id;
	private Integer day;
	//private Integer shift;
	private String timeStart;
	private String timeEnd;
	private String location;
	private String month;
	private String year;
	private String idemployee;
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public Integer getDay() {
		return day;
	}
	public void setDay(Integer day) {
		this.day = day;
	}
//	public Integer getShift() {
//		return shift;
//	}
//	public void setShift(Integer shift) {
//		this.shift = shift;
//	}
	public String getLocation() {
		return location;
	}
	public void setLocation(String location) {
		this.location = location;
	}
	public String getMonth() {
		return month;
	}
	public void setMonth(String month) {
		this.month = month;
	}
	public String getYear() {
		return year;
	}
	public void setYear(String year) {
		this.year = year;
	}
	public String getIdEmployee() {
		return idemployee;
	}
	public void setIdEmployee(String idemployee) {
		this.idemployee = idemployee;
	}
	
	public String getTimeStart() {
		return timeStart;
	}
	public void setTimeStart(String timeStart) {
		this.timeStart = timeStart;
	}
	public String getTimeEnd() {
		return timeEnd;
	}
	public void setTimeEnd(String timeEnd) {
		this.timeEnd = timeEnd;
	}
}
