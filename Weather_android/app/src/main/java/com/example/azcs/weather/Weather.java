package com.example.azcs.weather;

/**
 * Created by azcs on 04/04/16.
 */
public class Weather {
    int id ;
    String datetime ;
    float temp ;
    float humdity ;
    float smoke ;

    public Weather(int id, String datetime, float temp, float humdity, float smoke) {
        this.id = id;
        this.datetime = datetime;
        this.temp = temp;
        this.humdity = humdity;
        this.smoke = smoke;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDatetime() {
        return datetime;
    }

    public void setDatetime(String datetime) {
        this.datetime = datetime;
    }

    public float getTemp() {
        return temp;
    }

    public void setTemp(float temp) {
        this.temp = temp;
    }

    public float getHumdity() {
        return humdity;
    }

    public void setHumdity(float humdity) {
        this.humdity = humdity;
    }

    public float getSmoke() {
        return smoke;
    }

    public void setSmoke(float smoke) {
        this.smoke = smoke;
    }
}
