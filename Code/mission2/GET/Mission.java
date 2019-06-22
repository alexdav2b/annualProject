public class Mission {
    private String nom;
    private String debut;
    private String fin;


    public Mission(String nom, String debut, String fin) {
        this.nom = nom;
        this.debut = debut;
        this.fin = fin;
    }

    public Mission(){}

    public String getNom() {return nom;}

    public void setNom(String nom) {this.nom = nom;}

    public String getDebut() {return debut;}

    public void setDebut(String debut) {this.debut = debut;}

    public String getFin() {return fin;}

    public void setFin(String fin) {this.fin = fin;}

    @Override
    public String toString() {
        String res = "Nom : "+this.nom+
                "\nDébut : "+this.debut+
                "\nFin : "+this.fin;
        return res;
    }
}
