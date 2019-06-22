import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
public class Main {

    public Main() {}

    public static void main(String[] args) {

        System.out.println("Connection bdd :");

        String url = "jdbc:mysql://tn73658-001.dbaas.ovh.net:35148/FightFoodWaste?useTimezone=true&serverTimezone=UTC";
        String login = "natha";
        String passwd = "NathaNatha1";
        Connection connexion = null;
        Statement statement = null;
        Benevole x = new Benevole();
        try{
            Class.forName("com.mysql.jdbc.Driver");
            connexion = DriverManager.getConnection(url, login, passwd);
            statement = connexion.createStatement();
            ResultSet resultat = statement.executeQuery("SELECT ID, Name, Surname, Email FROM FightFoodWaste.usr WHERE Discriminator=\"Volunteer\" limit 1;");
            while (resultat.next()) {

                x.setId(resultat.getInt("ID"));
                x.setNom(resultat.getString("Name"));
                x.setPrenom(resultat.getString("Surname"));
                x.setEmail(resultat.getString("Email"));

                //Integer id = resultat.getInt("ID");
                //String name = resultat.getString("Name");
                //System.out.println("n "+id+" : "+name);
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
        System.out.println(x);
        x.sendMail();
    }
}
