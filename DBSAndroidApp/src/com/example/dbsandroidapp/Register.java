package com.example.dbsandroidapp;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.dbsandroidapp.Login.login;

import android.os.AsyncTask;
import android.os.Bundle;
import android.renderscript.Sampler.Value;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Register extends Activity {
EditText ednama,ednohp,edpass,edrepass,edemail;
Button bregister,bbatal;
JSONParser json=new JSONParser();
private ProgressDialog rDialog;
private static final String TAG_SUCCESS = "success";
private static final String TAG_message = "message";
String message=null;
private static String url = "http://10.0.2.2/dbs/Register.php";
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_register);
		ednama=(EditText)findViewById(R.id.ednama);
		ednohp=(EditText)findViewById(R.id.ednohp);
		edpass=(EditText)findViewById(R.id.edpassreg);
		edrepass=(EditText)findViewById(R.id.edrepass);
		edemail=(EditText)findViewById(R.id.edemail);
		
		bbatal=(Button)findViewById(R.id.bbatal);
		bbatal.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent back=new Intent(getApplicationContext(),Login.class);
				startActivity(back);
				finish();
			}
		});
		
		bregister=(Button)findViewById(R.id.bregister);
		bregister.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if((!ednama.getText().toString().equals(""))||(!ednohp.getText().toString().equals(""))||(!edpass.getText().toString().equals(""))||
						(!edrepass.getText().toString().equals(""))||(!edemail.getText().toString().equals(""))){
					if(ednama.getText().toString().length()>5){
						if(!edpass.getText().toString().equals(edrepass.getText().toString())){
							Toast.makeText(getApplicationContext(),"Password And Re-Password No Match", Toast.LENGTH_SHORT).show();
						}
						else{
						//registermya
						new Regreg().execute();
						}
					}
					else{
					Toast.makeText(getApplicationContext(),"Username should be minimum 5 characters", Toast.LENGTH_SHORT).show();
					}
					}
				else{
				Toast.makeText(getApplicationContext(),"Field Is Required", Toast.LENGTH_SHORT).show();
				}
				
						
					

				}
		});
	}
	
	class Regreg extends AsyncTask<String, String, String>{
		protected void onPreExecute(){
			super.onPreExecute();
			rDialog = new ProgressDialog(Register.this);
			rDialog.setMessage("Contacting Server....");
            rDialog.setIndeterminate(false);
            rDialog.setCancelable(true);
            rDialog.show();
		}

		@Override
		protected String doInBackground(String... params) {
			// TODO Auto-generated method stub
			String email=edemail.getText().toString();
			String pass=edpass.getText().toString();
			String nama=ednama.getText().toString();
			String nohp=ednohp.getText().toString();
			
			List<NameValuePair> param=new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("nama",nama));
			param.add(new BasicNameValuePair("nohp", nohp));
			param.add(new BasicNameValuePair("email",email));
			param.add(new BasicNameValuePair("pass", pass));
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
        protected void onPostExecute(String url) {
            rDialog.dismiss();
            if(url!=null&&url.equals("1")){
				Intent mymenu=new Intent(getApplicationContext(),Login.class);
                startActivity(mymenu);
                finish();
            }
            else{
            	Toast.makeText(getApplicationContext(), message,Toast.LENGTH_SHORT).show();
            }
        }
	}



}
