package com.example.azcs.weather;

import android.app.ProgressDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import java.util.List;

import retrofit.Callback;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.client.Response;

public class MainActivity extends AppCompatActivity {
    //Root URL of our web service
    public static final String ROOT_URL = "http://www.3zcs.net";

    private ListView mListview ;

    private List<Weather> mList ;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mListview =(ListView)findViewById(R.id.listViewData);
        getWeatherData();
    }

    private void getWeatherData() {
        final ProgressDialog loading = ProgressDialog.show(this,"Retrieving Data","Please wait...",false,false);
        RestAdapter adapter = new RestAdapter.Builder().setEndpoint(ROOT_URL).build();
        WeatherAPI weather = adapter.create(WeatherAPI.class);
        weather.getWeather(new Callback<List<Weather>>() {
            @Override
            public void success(List<Weather> weathers, Response response) {
                mList = weathers;
                loading.dismiss();
                showList();
            }

            @Override
            public void failure(RetrofitError error) {
                loading.setMessage(String.valueOf(error));

            }
        });
    }

    private void showList() {
        String data [] = new String[5];
        //Toast.makeText(this,String.valueOf(mList.get(0).getHumdity()),Toast.LENGTH_SHORT).show();
        data[0] = "Id : " + String.valueOf(mList.get(0).getId());
        data[1] = "Date - Time : " + mList.get(0).getDatetime();
        data[2] = "Humdity : "+String.valueOf(mList.get(0).getHumdity());
        data[3] = "Tempruter : "+String.valueOf(mList.get(0).getTemp());
        data[4] = "Smoke = "+String.valueOf(mList.get(0).getSmoke());
        //Toast.makeText(this,data[1],Toast.LENGTH_SHORT).show();
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,data);
        mListview.setAdapter(adapter);

    }

}
