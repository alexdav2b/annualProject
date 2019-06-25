import java.awt.List;
import java.io.FileWriter;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.InputMismatchException;
import java.util.Scanner;
//import java.util.List;
import static java.nio.file.StandardOpenOption.APPEND;


public class Main {

    public Main() {}

    public static void main(String[] args) {

        System.out.println("Connection bdd :");

        String url = "jdbc:mysql://137.74.118.225:3306/fightfoodwaste?useTimezone=true&serverTimezone=UTC";
        String login = "website";
        String passwd = "website";
        Connection connexion = null;
        Statement statement = null;
        //
        int nbUsr = 0;
        
        //
        //Count du nombre de bévévole avec des missions pour demain
        
        try{
            Class.forName("com.mysql.jdbc.Driver");
            connexion = DriverManager.getConnection(url, login, passwd);
            statement = connexion.createStatement();
            ResultSet resultat = statement.executeQuery("SELECT count( distinct usr.id) as nb\r\n" + 
            		"FROM fightfoodwaste.usr \r\n" + 
            		"inner join fightfoodwaste.mission on usr.ID = mission.UsrID\r\n" + 
            		"where mission.DateStart > (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 1 DAY) as datetime) as date)\r\n" + 
            		"and mission.DateStart < (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 2 DAY) as datetime) as date);");
            while (resultat.next()) {
            	nbUsr = resultat.getInt("nb");
            }
            
        }catch (SQLException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } finally {
            try {
                connexion.close();
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        
        //Création du tableau de Benevole
        Benevole[] lsUsr;
        lsUsr = new Benevole[nbUsr];
                
        
        //Recherche des Benevole
        try{
            Class.forName("com.mysql.jdbc.Driver");
            connexion = DriverManager.getConnection(url, login, passwd);
            statement = connexion.createStatement();
            ResultSet resultat = statement.executeQuery("SELECT distinct usr.id, usr.Name, usr.Surname, usr.Email\r\n" + 
            		"FROM fightfoodwaste.usr \r\n" + 
            		"inner join fightfoodwaste.mission on usr.ID = mission.UsrID\r\n" + 
            		"where mission.DateStart > (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 1 DAY) as datetime) as date)\r\n" + 
            		"and mission.DateStart < (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 2 DAY) as datetime) as date);");
            int temp = 0;
            while (resultat.next() && temp < nbUsr) {
            	lsUsr[temp] = new Benevole();
            	lsUsr[temp].setId(resultat.getInt("ID"));
            	lsUsr[temp].setNom(resultat.getString("Surname"));
            	lsUsr[temp].setPrenom(resultat.getString("Name"));
            	lsUsr[temp].setEmail(resultat.getString("Email"));
                temp++ ;
            }
        }catch (SQLException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } finally {
            try {

                connexion.close();
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        
        
        //Affichage du bénévole
        int i = 0;
        for(i = 0 ; i<nbUsr ; i++) {
        	System.out.println(lsUsr[i]);
        }
        
        //Select count du nb de mission pour demain
        int nbMsn = 0;
        
        try{
            Class.forName("com.mysql.jdbc.Driver");
            connexion = DriverManager.getConnection(url, login, passwd);
            statement = connexion.createStatement();
            ResultSet resultat = statement.executeQuery("select count(mission.ID) as nb\r\n" + 
            		"from mission inner join service on mission.ServiceID = service.ID\r\n" + 
            		"where mission.DateStart > (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 1 DAY) as datetime) as date)\r\n" + 
            		"and mission.DateStart < (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 2 DAY) as datetime) as date);");
            while (resultat.next()) {
            	nbMsn = resultat.getInt("nb");
            }
            
        }catch (SQLException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } finally {
            try {
                connexion.close();
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        
        //Select des missions pour demain pour les bénévoles
        
        Mission[] lsMsn;
        lsMsn = new Mission[nbMsn];
        
        try{
            Class.forName("com.mysql.jdbc.Driver");
            connexion = DriverManager.getConnection(url, login, passwd);
            statement = connexion.createStatement();
            ResultSet resultat = statement.executeQuery("select service.Name, mission.UsrID, mission.DateStart, mission.DateEnd\r\n" + 
            		"from mission inner join service on mission.ServiceID = service.ID\r\n" + 
            		"where mission.DateStart > (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 1 DAY) as datetime) as date)\r\n" + 
            		"and mission.DateStart < (select cast(ADDDATE(CURRENT_DATE(), INTERVAL 2 DAY) as datetime) as date) \r\n" + 
            		"order by mission.DateStart;");
            int temp = 0;
            while (resultat.next() && temp < nbMsn) {
            	lsMsn[temp] = new Mission();
            	
            	lsMsn[temp].setNom(resultat.getString("Name"));
            	lsMsn[temp].setIdUsr(resultat.getInt("UsrID"));
            	lsMsn[temp].setDebut(resultat.getString("DateStart"));
            	lsMsn[temp].setFin(resultat.getString("DateEnd"));
            	
                temp++ ;
            }
        }catch (SQLException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } finally {
            try {
                // Etape 6 : libérer ressources de la mémoire proprement
                connexion.close();
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        int j = 0 ;
        for(j = 0 ; j<nbMsn ; j++) {
        	System.out.println(lsMsn[j] + "\n");
        }
        
        //Création des fichier CSV et envoie des mails
        
        String separateur = ";";
        String path = "C:\\data\\csv\\";
        String filename = "";
        
        ArrayList<String[]> myList = new ArrayList<String[]>();
        
        for(i = 0; i<nbUsr ; i++) {
        	filename = ""+lsUsr[i].getId()+".csv";
        	myList = new ArrayList<String[]>();
        	myList.add(new String[]{"Mision ","Début","Fin"});
        	for(j = 0; j<nbMsn ; j++) {
        		if( lsUsr[i].getId() == lsMsn[j].getIdUsr()) {
        			myList.add(new String[]{lsMsn[j].getNom() , lsMsn[j].getDebut() , lsMsn[j].getFin() });
        		}        		
        	}
        	WriteToCsvFile( myList, separateur, path+filename); 
        	lsUsr[i].sendMail();
        }
                
        System.out.println("Finish !!!!");
    }
    
    public static void WriteToCsvFile(ArrayList<String[]> thingsToWrite, String separator, String fileName){
        try (FileWriter writer = new FileWriter(fileName)){
            for (String[] strings : thingsToWrite) {
                for (int i = 0; i < strings.length; i++) {
                    writer.append(strings[i]);
                    if(i < (strings.length-1))
                        writer.append(separator);
                }
                writer.append(System.lineSeparator());
            }
            writer.flush();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
