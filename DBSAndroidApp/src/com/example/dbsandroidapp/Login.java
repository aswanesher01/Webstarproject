package com.example.dbsandroidapp;

import java.util.ArrayList;
import java.util.List;
import java.util.jar.Attributes.Name;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class Login extends Activity {
EditText eemail,epass;
Button blogin,bregister;
TextView terror;
JSONParser json=new JSONParser();
private ProgressDialog lDialog;
private static final String TAG_SUCCESS = "success";
private static String url = "http://10.0.2.2/webstarproject/dbs/login.php";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);
		eemail=(EditText)findViewById(R.id.edEmail);
		epass=(EditText)findViewById(R.id.edpass);
		blogin=(Button)findViewById(R.id.blogin);
		bregister=(Button)findViewById(R.id.bregis);
		terror=(TextView)findViewById(R.id.texterror);
		
		bregister.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent register=new Intent(getApplicationContext(),Register.class);
				startActivity(register);
				finish();
			}
		});
		
		blogin.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if((!eemail.getText().toString().equals(""))||(!epass.getText().toString().equals(""))){
					new login().execute();
				}
				else{
					Toast.makeText(getApplicationContext(), "Field Email & Password Is Required",Toast.LENGTH_SHORT).show();
				}
			}
		});
		
	}
	
	class login extends AsyncTask<String, String, String>{
		
		protected void onPreExecute(){
			super.onPreExecute();
			lDialog = new ProgressDialog(Login.this);
			lDialog.setMessage("Checking Server....");
            lDialog.setIndeterminate(false);
            lDialog.setCancelable(true);
            lDialog.show();
		}

		@Override
		protected String doInBackground(String... params) {
			// TODO Auto-generated method stub
			String email=eemail.getText().toString();
			String pass=epass.getText().toString();
			
			List<NameValuePair> param=new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("email",email));
			param.add(new BasicNameValuePair("pass", pass));
			
			JSONObject js=json.makeHttpRequest(url, "POST", param);
			Log.d("Checking Response", json.toString());
			
			try{
				int suks=js.getInt(TAG_SUCCESS);
				if(suks==1){
					return "1";
				}
				else{
					return "0";
				}
			}catch (JSONException e) {
				 e.printStackTrace();
			}
			return null;
		}
        protected void onPostExecute(String url) {
            lDialog.dismiss();
            if(url!=null&&url.equals("1")){
				Intent mymenu=new Intent(getApplicationContext(),Menudbs.class);
                startActivity(mymenu);
                finish();
            }
            else{
            	Toast.makeText(getApplicationContext(), "Email & Password Is Correct",Toast.LENGTH_SHORT).show();
            }
        }
	}



}
