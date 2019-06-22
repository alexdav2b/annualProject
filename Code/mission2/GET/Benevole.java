
import javax.mail.*;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import java.util.Properties;

public class Benevole {

    private int id;
    private String nom;
    private String prenom;
    private String email;

    public Benevole(){}

    public Benevole(int id, String nom, String prenom, String email) {
        this.id = id;
        this.nom = nom;
        this.prenom = prenom;
        this.email = email;
    }
    public int getId() {return id;}

    public void setId(int id) {this.id = id;}

    public String getNom() {return nom;}

    public void setNom(String nom) {this.nom = nom;}

    public String getPrenom() {return prenom;}

    public void setPrenom(String prenom) {this.prenom = prenom;}

    public String getEmail() {return email;}

    public void setEmail(String email) {this.email = email;}

    @Override
    public String toString() {
        String res = "Id : "+this.id+"\n"+
                    "Nom : "+this.nom+"\n"+
                    "Prenom : "+this.prenom+"\n"+
                    "Email : "+this.email+"\n";
        return res;
    }

    //Faire un méthode pour envoyé un mail avec un fichier CSV avec un nom de fichier générique

    public void sendMail(){

        // 1 -> Création de la session
        Properties properties = new Properties();
        properties.setProperty("mail.transport.protocol", "smtp");
        properties.setProperty("mail.smtp.host", "smpt.free.fr");
        properties.setProperty("mail.smtp.user", "nathanael.to@free.fr");
        properties.setProperty("mail.from", "nathanael.to@free.fr");
        properties.setProperty("mail.smtp.starttls.enable", "true");
        Session session = Session.getInstance(properties);

        // 2 -> Création du message
        MimeMessage message = new MimeMessage(session);
        try {
            String txt = "Bonjour "+this.prenom+"<br>Ceci est pour l'envoie des emploie du temps depuis java";
            message.setText(txt);
            message.setSubject("Gestion emploie du temps PA");
            message.addRecipients(Message.RecipientType.TO, this.email);
            //message.addRecipients(Message.RecipientType.CC, copyDest);
        } catch (MessagingException e) {
            e.printStackTrace();
        }

        // 3 -> Envoi du message
        Transport transport = null;
        try {
            transport = session.getTransport("smtp");
            transport.connect("nathanael.to@free.fr", "nto1402");
            transport.sendMessage(message, new Address[] {
                    new InternetAddress(this.email)
                    //,new InternetAddress(copyDest)
            });
        } catch (MessagingException e) {
            e.printStackTrace();
        } finally {
            try {
                if (transport != null) {
                    transport.close();
                }
            } catch (MessagingException e) {
                e.printStackTrace();
            }
        }
    }

}
