package Project;
import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.MalformedURLException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javazoom.jl.player.advanced.*;
import sun.audio.*;
//import javax.media.*; 
//import javax.media.format.AudioFormat;
import javax.swing.*;

import javazoom.jl.player.Player;
public class TestFileChooser {
	
	static MusicPlayer mp;

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		JFrame frame=new JFrame("OSP");
		final JFileChooser fc;
		fc=new JFileChooser();
		frame.setDefaultCloseOperation(frame.EXIT_ON_CLOSE);
		frame.setSize(200, 200);
		frame.setVisible(true);
		final JPanel panel=new JPanel();
		final JButton stop=new JButton("stop");
		final JButton butt=new JButton("play");
		final JButton resume=new JButton("pause/resume");
		
		butt.addActionListener(new ActionListener(){

			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				fc.showOpenDialog(fc);
			}});
		
		stop.addActionListener(new ActionListener(){

			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				mp.t1.stop();
			//	mp.t2.stop();
			}});
		

		resume.addActionListener(new ActionListener(){

			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				mp.position=mp.playMP3.getPosition();
				System.out.println("position is "+mp.position);
				if(mp.stat==true)
				{mp.t1.suspend();mp.stat=false;}
				else
					{mp.t1.resume();mp.stat=true;}
			}});
		frame.add(panel);
		final JTextField tb1=new JTextField("");
		tb1.setPreferredSize(new Dimension(150,30));
		JSlider sl=new JSlider();
		final JTextField tb2=new JPasswordField("");
		tb2.setPreferredSize(new Dimension(150,30));
	//	tb1.setText("");
		final JButton submit=new JButton("submit");
		
		submit.addActionListener(new ActionListener(){

			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				try {
					Class.forName("com.mysql.jdbc.Driver");
					Connection con=DriverManager.getConnection("jdbc:mysql://localhost/musicmanager?"+ "user=root&password=");
					Statement stmt=con.createStatement();
					String sql="select username,password from login where username='"+tb1.getText()+"' and password='"+tb2.getText()+"';";
					ResultSet rs=stmt.executeQuery(sql);
					rs.next();
					if(rs.getString("username").equals(tb1.getText()))
					{
						if(rs.getString("password").equals(tb2.getText()))
						{
							panel.remove(tb2);
							panel.remove(tb1);
							panel.remove(submit);
							panel.add(butt);
							panel.add(stop);
							panel.add(resume);
							panel.updateUI();
						}
						else tb2.setText("Password Error");
					}
					else tb1.setText("Username Error");

				} catch (Exception e) {
					// TODO Auto-generated catch block
					System.out.println(e.getMessage());
				}
				
			}});
	//	tb2.setText("");
		panel.add(tb1,new FlowLayout());
		panel.add(tb2,new FlowLayout());
		panel.add(submit,new FlowLayout());
		
		panel.updateUI();
		fc.setCurrentDirectory(new File("D:\\Music"));
		fc.addActionListener(new ActionListener(){

			@Override
			public void actionPerformed(ActionEvent arg0) {
				// TODO Auto-generated method stub
				System.out.println((fc.getSelectedFile()));
			//	System.out.println(fc.getCurrentDirectory());
				
				mp=new MusicPlayer();
				
				
				
				Operate o=new Operate(""+(fc.getSelectedFile()),tb1.getText());
				try {
				
					System.out.println("playing song");
				o.main(null);
					mp.src=""+fc.getSelectedFile();
				mp.t1.start();
				mp.stat=true;
				} catch (Exception e) {
					// TODO Auto-generated catch block
					System.out.println(e.getMessage());
				}
			
			}});
		
	}

}
class MusicPlayer //extends Thread
{
	@SuppressWarnings("restriction")
	Player playMP3 =null;
	String src="";
	 int position=0;
	boolean stat=false;
	Thread t1=new Thread(){
	public void run()
	{try{
	    FileInputStream fis = new FileInputStream(src);
	    playMP3= new Player(fis);
	    playMP3.play();
	    
	    
	//   
	}
	catch(Exception exc){
		System.out.println(exc.getMessage());
	
	    System.out.println("Failed to play the file.");
	}
		
	
	}

	
	};

	
}

