package com.example.azcs.weather;

/**
 * Created by azcs on 04/04/16.
 */
import java.util.List;
import retrofit.Callback;
import retrofit.http.GET;

public interface WeatherAPI {

    @GET("/webs/data/android")
    public void getWeather(Callback<List<Weather>> response);

}
