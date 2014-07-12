package com.example.dbsandroidapp;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.app.ProgressDialog;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Menudbs extends Activity {
EditText ednopol,edstnk,edbpkb,edpmbtn;
Button bsell;
JSONParser json=new JSONParser();
private ProgressDialog sDialog;
private static final String TAG_SUCCESS = "success";
private static final String TAG_message = "message";
String message=null;
private static String url = "http://10.0.2.2/dbs/sell.php";
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_menudbs);
		
		ednopol=(EditText)findViewById(R.id.ednopol);
		edstnk=(EditText)findViewById(R.id.edstnk);
		edbpkb=(EditText)findViewById(R.id.edbpkb);
		edpmbtn=(EditText)findViewById(R.id.edthnpmb);
		bsell=(Button)findViewById(R.id.bsel);
		
		bsell.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if((!ednopol.getText().toString().equals(""))||(!edstnk.getText().toString().equals(""))||(
						!edbpkb.getText().toString().equals(""))||(!edpmbtn.getText().toString().equals(""))){
					
				}
				else{
					Toast.makeText(getApplicationContext(),"Fields Required",Toast.LENGTH_SHORT).show();
				}
				
			}
		});
		
		
	}
class Seller extends AsyncTask<String, String, String>{
	protected void onPreExecute(){
		super.onPreExecute();
		sDialog = new ProgressDialog(Menudbs.this);
		sDialog.setMessage("Contacting Server....");
        sDialog.setIndeterminate(false);
        sDialog.setCancelable(true);
        sDialog.show();
	}
	@Override
	protected String doInBackground(String... params) {
		// TODO Auto-generated method stub
		String nopol=ednopol.getText().toString();
		String nostnk=edstnk.getText().toString();
		String nobpkb=edbpkb.getText().toString();
		String nopmbtn=edpmbtn.getText().toString();
		
		List<NameValuePair> param=new ArrayList<NameValuePair>();
		param.add(new BasicNameValuePair("nopol",nopol));
		param.add(new BasicNameValuePair("nostnk", nostnk));
		param.add(new BasicNameValuePair("nobpkb",nobpkb));
		param.add(new BasicNameValuePair("pmbtn", nopmbtn));
		JSONObject js=json.makeHttpRequest(url, "POST", param);
		Log.d("Checking Response", json.toString());
		try{
			int suks=js.getInt(TAG_SUCCESS);
			message=js.getString(TAG_message);
			if(suks==1){
				return "1";	
			}
			else{
				return Integer.toString(suks);
			}
		}catch (JSONException e) {
			 e.printStackTrace();
		}
		return null;
	}
	
}

}
