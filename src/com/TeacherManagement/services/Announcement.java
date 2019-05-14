package com.TeacherManagement.services;

import java.util.Date;

public class Announcement {

	private String id;
	private String title;
	private String content;
	private String idadmin;
	private Date datepost;
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String getTitle() {
		return title;
	}
	public void setTitle(String title) {
		this.title = title;
	}
	public String getContent() {
		return content;
	}
	public void setContent(String content) {
		this.content = content;
	}
	public String getIdadmin() {
		return idadmin;
	}
	public void setIdadmin(String idadmin) {
		this.idadmin = idadmin;
	}
	public Date getDatepost() {
		return datepost;
	}
	public void setDatepost(Date datepost) {
		this.datepost = datepost;
	}
	
	public Announcement(String id, String title, String content, String idadmin, Date datepost) {
		super();
		this.id = id;
		this.title = title;
		this.content = content;
		this.idadmin = idadmin;
		this.datepost = datepost;
	}
	
	public Announcement() {
		
	}
}
