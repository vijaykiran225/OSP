package Project;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.sql.*;

import org.apache.tika.exception.TikaException;
import org.apache.tika.metadata.Metadata;
import org.apache.tika.metadata.Property;
import org.apache.tika.parser.AutoDetectParser;
import org.apache.tika.parser.ParseContext;
import org.apache.tika.parser.Parser;
//import org.apache.tika.parser
import org.apache.tika.parser.mp3.Mp3Parser;
import org.xml.sax.ContentHandler;
import org.xml.sax.SAXException;
import org.xml.sax.helpers.DefaultHandler;

import com.mysql.jdbc.PreparedStatement;

public class Operate {

	static String audioFileLoc = "D:\\Music\\from home\\New folder (2)\\";
	private static String tablename;
	
	public Operate(String Name, String string)
	{
		if(Name!=null)
		audioFileLoc=Name;
		else
			audioFileLoc+="05.Katy Perry - Peacock.mp3";
		
		this.tablename=string;
	}
	
public static void main(String []args) throws ClassNotFoundException, SQLException {

//String path = "D:/Music/from home/New folder (2)/05.Katy Perry - Peacock.mp3";

try {

InputStream input = new FileInputStream(new File(audioFileLoc));
ContentHandler handler = new DefaultHandler();//interface =new class obj
Metadata metadata = new Metadata();//empty
Parser parser = new AutoDetectParser();
ParseContext parseCtx = new ParseContext();
parser.parse(input, handler, metadata, parseCtx);//input , o/p o/p optional


input.close();


String[] metadataNames = metadata.names();
for(String name : metadataNames){
	
//System.out.println(name + ": \t\t\t" + metadata.get(name));

}
System.out.println("Title: " + metadata.get("title"));
System.out.println("Artists: " + metadata.get("xmpDM:artist"));
System.out.println("Album: " + metadata.get("xmpDM:album"));
System.out.println("Genre: " + metadata.get("xmpDM:genre"));
System.out.println("Release Date: " + metadata.get("xmpDM:releaseDate"));
System.out.println("Duration: " + metadata.get("xmpDM:duration"));
//System.out.println("Channel Type: " + metadata.get("xmpDM:audioChannelType"));
System.out.println("Author: " + metadata.get("Author"));

Class.forName("com.mysql.jdbc.Driver");
Connection con=DriverManager.getConnection("jdbc:mysql://localhost/userdata?"+ "user=root&password=");
Statement stmt=con.createStatement();

java.sql.PreparedStatement preparedStatement;
//con=DriverManager.getConnection("jdbc:mysql://localhost/userdata?"+ "user=root&password=");
 stmt=con.createStatement();
preparedStatement = con.prepareStatement("insert into userdata."+tablename+"log values (default, ?, ?, ?, ?, ? , ?, ?,default,default)");

preparedStatement.setString(1, metadata.get("title"));//name
preparedStatement.setString(2, metadata.get("xmpDM:artist"));//artist
preparedStatement.setString(3, metadata.get("xmpDM:album"));//album
preparedStatement.setString(4, metadata.get("xmpDM:genre"));//genre
preparedStatement.setString(5, metadata.get("xmpDM:releaseDate"));//reldate
preparedStatement.setString(6, metadata.get("xmpDM:duration"));//duration
preparedStatement.setString(7, metadata.get("Author"));//author
preparedStatement.executeUpdate();
con.close();







} catch (FileNotFoundException e) {
	System.out.println(e.getMessage());

} catch (IOException e) {
	System.out.println(e.getMessage());
} catch (SAXException e) {
	System.out.println(e.getMessage());
} catch (TikaException e) {
	System.out.println(e.getMessage());
}
}
}
