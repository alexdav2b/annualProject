
import javax.mail.*;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;

import java.io.File;
import java.util.Properties;
import javax.activation.*;

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
    public int getId() {return this.id;}

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

   
    public void sendMail() {
    	
    	
    	// 1 -> Création de la session
        Properties properties = new Properties();
        properties.setProperty("mail.transport.protocol", "smtp");
        properties.setProperty("mail.smtp.host", "smtp.free.fr");
        properties.setProperty("mail.smtp.user", "nathanael.to@free.fr");
        properties.setProperty("mail.from", "nathanael.to@free.fr");
        properties.setProperty("mail.smtp.starttls.enable", "true");
        Session session = Session.getInstance(properties);
        
        File file = new File("C:\\data\\csv\\" +this.id+ ".csv");
        FileDataSource datasource1 = new FileDataSource(file);
        DataHandler handler1 = new DataHandler(datasource1);
        
        MimeBodyPart kaneki = new MimeBodyPart();
        try {
        	kaneki.setDataHandler(handler1);
        	kaneki.setFileName(datasource1.getName());
        } catch (MessagingException e) {
            e.printStackTrace();
        }
        
        MimeBodyPart content = new MimeBodyPart();
        String txt = "Bonjour "+this.prenom+"\nVoici votre emploie du temps pour demain.\nCordialement\nLa direction FightFoodWaste";
        try {
            content.setContent(txt, "text/plain");
        } catch (MessagingException e) {
            e.printStackTrace();
        }
        
        MimeMultipart mimeMultipart = new MimeMultipart();
        try {
            mimeMultipart.addBodyPart(content);
            mimeMultipart.addBodyPart(kaneki);
        } catch (MessagingException e) {
            e.printStackTrace();
        }
        
        // 2 -> Création du message
        MimeMessage message = new MimeMessage(session);
        try {
            message.setContent(mimeMultipart);
            message.setSubject("Gestion emploie du temps PA");
            message.addRecipients(Message.RecipientType.TO, this.email);
            message.addRecipients(Message.RecipientType.CC, "nto.rider@gmail.com");
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
        System.out.println("Mail envoyé !!");
        
        
    }    	
}

