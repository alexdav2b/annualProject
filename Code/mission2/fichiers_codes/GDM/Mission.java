public class Mission {
    private String nom;
    private String debut;
    private String fin;
    private int idUsr;

    public Mission(String nom, String debut, String fin, int idUsr) {
        this.nom = nom;
        this.idUsr = idUsr;
        this.debut = debut;
        this.fin = fin;
    }
    
    public Mission(){}

    public int getIdUsr() {return this.idUsr;}
    
    public void setIdUsr(int id) {this.idUsr = id;}
    
    public String getNom() {return nom;}

    public void setNom(String nom) {this.nom = nom;}

    public String getDebut() {return debut;}

    public void setDebut(String debut) {this.debut = debut;}

    public String getFin() {return fin;}

    public void setFin(String fin) {this.fin = fin;}

    @Override
    public String toString() {
        String res = "Nom : "+this.nom+
        		"\nPour l'usr, id : "+this.idUsr+
                "\nDébut : "+this.debut+
                "\nFin : "+this.fin;
        return res;
    }
}
