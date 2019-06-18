import java.awt.Container;
import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.swing.Box;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;
import javax.swing.SwingConstants;
import javax.swing.WindowConstants;

public class GBS extends JFrame {

	private static JTextField fieldSurname = null;
	private static JTextField fieldName = null;
	private static JTextField fieldMail = null;
	private static JTextField fieldPassword = null;
	private static JTextField fieldAddressNumber = null;
	private static JTextField fieldAddressLabel = null;
	private static JTextField fieldPostCode = null;
	private static JTextField fieldArea = null;
	private static Integer resultIdForUpdate = null;
	private static String resultMail = null;
	private static JTextField fieldMessage = null;
	private static JTextField fieldId = null;

	private static JComboBox<?> fieldSite = null;
	private static JTextField fieldSiteChoiced = null;

	private static JComboBox<?> fieldService = null;
	private static JTextField fieldServiceChoiced = null;

	private static JComboBox<?> fieldCompetence = null;
	private static JTextField fieldCompetenceChoiced = null;

	private static Connection connexion = null;
	private static Statement statement = null;

	private static final String url = "jdbc:mysql://137.74.118.225:3306/fightfoodwaste?useTimezone=true&serverTimezone=UTC";
	private static final String login = "website"; // Un admin de la base : root
	private static final String passwd = "website"; // éventuel un pwd d'administration

	private static final boolean isDebug = false;

	@SuppressWarnings("unchecked")
	public static void main(String argv[]) {

		JFrame f = new JFrame("Gestion des bénévoles");
		f.setSize(700, 500);
		f.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE);
		Dimension dim = Toolkit.getDefaultToolkit().getScreenSize();
		f.setLocation(dim.width / 2 - f.getWidth() / 2, dim.height / 2 - f.getHeight() / 2);

		// Hbox1
		// Adresse mail
		Box hBox1 = Box.createHorizontalBox();
//		hBox1.setAlignmentX(10);
		fieldMail = new JTextField(50);
		JLabel labelMail = new JLabel("Adresse mail : ", SwingConstants.LEFT);
		fieldMail.setMaximumSize(fieldMail.getPreferredSize());
		hBox1.add(labelMail);
		hBox1.add(Box.createHorizontalStrut(5));
		hBox1.add(fieldMail);
		hBox1.add(Box.createHorizontalStrut(20));

		fieldId = new JTextField(20);
		JLabel labelfieldId = new JLabel("Identifiant : ", SwingConstants.LEFT);
		fieldId.setMaximumSize(fieldMail.getPreferredSize());
		fieldId.setEditable(false);
		hBox1.add(labelfieldId);
		hBox1.add(Box.createHorizontalStrut(5));
		hBox1.add(fieldId);
		hBox1.add(Box.createHorizontalStrut(5));

		fieldPassword = new JTextField(50);
		JLabel labelPassword = new JLabel("Mot de passe : ", SwingConstants.LEFT);
		fieldPassword.setMaximumSize(fieldPassword.getPreferredSize());
		hBox1.add(labelPassword);
		hBox1.add(Box.createHorizontalStrut(5));
		hBox1.add(fieldPassword);

		// HBox2
		// Nom de famille
		Box hBox2 = Box.createHorizontalBox();
		fieldSurname = new JTextField(30);
		JLabel labelSurname = new JLabel("Nom : ", SwingConstants.LEFT);
		fieldSurname.setMaximumSize(fieldSurname.getPreferredSize());
		hBox2.add(labelSurname);
		hBox2.add(Box.createHorizontalStrut(5));
		hBox2.add(fieldSurname);
		hBox2.add(Box.createHorizontalStrut(5));

		// Prénom
		fieldName = new JTextField(30);
		JLabel labelName = new JLabel("Prénom : ", SwingConstants.LEFT);
		fieldName.setMaximumSize(fieldName.getPreferredSize());
		hBox2.add(labelName);
		hBox2.add(Box.createHorizontalStrut(5));
		hBox2.add(fieldName);

		// hBox4
		// Adresse Numéro
		Box hBox4 = Box.createHorizontalBox();
		fieldAddressNumber = new JTextField(10);
		JLabel labelAddressNumber = new JLabel("N° Adresse : ", SwingConstants.LEFT);
		fieldAddressNumber.setMaximumSize(fieldAddressNumber.getPreferredSize());
		hBox4.add(labelAddressNumber);
		hBox4.add(Box.createHorizontalStrut(5));
		hBox4.add(fieldAddressNumber);
		hBox4.add(Box.createHorizontalStrut(5));

		// Adresse Nom rue
		fieldAddressLabel = new JTextField(50);
		JLabel labelAddressLabel = new JLabel("Rue : ", SwingConstants.LEFT);
		fieldAddressLabel.setMaximumSize(fieldAddressLabel.getPreferredSize());
		hBox4.add(labelAddressLabel);
		hBox4.add(Box.createHorizontalStrut(5));
		hBox4.add(fieldAddressLabel);

		// hBox5
		// Adresse Code postal
		Box hBox5 = Box.createHorizontalBox();
		fieldPostCode = new JTextField(10);
		JLabel labelPostCode = new JLabel("Code postal : ", SwingConstants.LEFT);
		fieldPostCode.setMaximumSize(fieldPostCode.getPreferredSize());
		hBox5.add(labelPostCode);
		hBox5.add(Box.createHorizontalStrut(5));
		hBox5.add(fieldPostCode);
		hBox5.add(Box.createHorizontalStrut(5));

		// Nom de la ville
		fieldArea = new JTextField(50);
		JLabel labelArea = new JLabel("Ville : ", SwingConstants.LEFT);
		fieldArea.setMaximumSize(fieldArea.getPreferredSize());
		hBox5.add(labelArea);
		hBox5.add(Box.createHorizontalStrut(5));
		hBox5.add(fieldArea);

		// liste des sites

		Box hBox6 = Box.createHorizontalBox();
		fieldSite = new JComboBox(construireListeSites());
		fieldSite.setMaximumSize(fieldSite.getPreferredSize());
		JLabel labelSite = new JLabel("Sites possibles : ", SwingConstants.LEFT);
		ActionListener siteChoiceActionListener = new siteChoiceAction();
		fieldSite.addActionListener(siteChoiceActionListener);
		hBox6.add(labelSite);
		hBox6.add(Box.createHorizontalStrut(5));
		hBox6.add(fieldSite);

		hBox6.add(Box.createGlue());
		fieldSiteChoiced = new JTextField(30);
		fieldSiteChoiced.setEditable(false);
		JLabel labelSiteChoiced = new JLabel("Site choisi : ", SwingConstants.LEFT);
		fieldSiteChoiced.setMaximumSize(fieldSiteChoiced.getPreferredSize());
		hBox6.add(labelSiteChoiced);
		hBox6.add(Box.createHorizontalStrut(5));
		hBox6.add(fieldSiteChoiced);

		// liste des services

		Box hBox7 = Box.createHorizontalBox();
		fieldService = new JComboBox(construireListeServices());
		fieldService.setMaximumSize(fieldService.getPreferredSize());
		JLabel labelService = new JLabel("Services possibles : ", SwingConstants.LEFT);
		ActionListener serviceChoiceActionListener = new serviceChoiceAction();
		fieldService.addActionListener(serviceChoiceActionListener);
		hBox7.add(labelService);
		hBox7.add(Box.createHorizontalStrut(5));
		hBox7.add(fieldService);

//		
		hBox7.add(Box.createGlue());
		fieldServiceChoiced = new JTextField(30);
		fieldServiceChoiced.setEditable(false);
		JLabel labelServiceChoiced = new JLabel("Service choisi : ", SwingConstants.LEFT);
		fieldServiceChoiced.setMaximumSize(fieldServiceChoiced.getPreferredSize());
		hBox7.add(labelServiceChoiced);
		hBox7.add(Box.createHorizontalStrut(5));
		hBox7.add(fieldServiceChoiced);

		// liste des compétences

		Box hBox8 = Box.createHorizontalBox();
		fieldCompetence = new JComboBox(construireListeCompetences());
		fieldCompetence.setMaximumSize(fieldCompetence.getPreferredSize());
		JLabel labelCompetence = new JLabel("Compétences possibles : ", SwingConstants.LEFT);
		ActionListener competenceChoiceActionListener = new competenceChoiceAction();
		fieldCompetence.addActionListener(competenceChoiceActionListener);
		hBox8.add(labelCompetence);
		hBox8.add(Box.createHorizontalStrut(5));
		hBox8.add(fieldCompetence);

//		
		hBox8.add(Box.createGlue());
		fieldCompetenceChoiced = new JTextField(30);
		fieldCompetenceChoiced.setEditable(false);
		JLabel labelCompetenceChoiced = new JLabel("Compétence choisie : ", SwingConstants.LEFT);
		fieldCompetenceChoiced.setMaximumSize(fieldCompetenceChoiced.getPreferredSize());
		hBox8.add(labelCompetenceChoiced);
		hBox8.add(Box.createHorizontalStrut(5));
		hBox8.add(fieldCompetenceChoiced);

		//
		Box hBox19 = Box.createHorizontalBox();
		fieldMessage = new JTextField(50);
		JLabel labelMessage = new JLabel("Informations : ", SwingConstants.LEFT);
		fieldMessage.setMaximumSize(fieldMessage.getPreferredSize());
		hBox19.add(labelMessage);
		hBox19.add(Box.createHorizontalStrut(5));
		hBox19.add(fieldMessage);

		//
		Box hBox20 = Box.createHorizontalBox();
		JButton buttonSearch = new JButton("Rechercher par mail");
		buttonSearch.addActionListener(new BoutonListenerSearch());
		hBox20.add(buttonSearch);
		hBox20.add(Box.createGlue());

		JButton buttonRAZ = new JButton("RAZ champs");
		buttonRAZ.addActionListener(new BoutonListenerRAZ());
		hBox20.add(buttonRAZ);
		hBox20.add(Box.createGlue());

		JButton buttonCreate = new JButton("Créer nouveau bénévole");
		buttonCreate.addActionListener(new BoutonListenerCreate());
		hBox20.add(buttonCreate);
		hBox20.add(Box.createGlue());

		JButton buttonUpdate = new JButton("Mettre à jour bénévole");
		buttonUpdate.addActionListener(new BoutonListenerUpdate());
		hBox20.add(buttonUpdate);

		// assemblage des Box
		Box vBox = Box.createVerticalBox();
		vBox.add(hBox1);
		vBox.add(hBox2);
		vBox.add(hBox4);
		vBox.add(hBox5);
		vBox.add(hBox6);
		vBox.add(hBox7);
		vBox.add(hBox8);

		vBox.add(hBox19);
		vBox.add(Box.createGlue());
		vBox.add(hBox20);

		Container c = f.getContentPane();
//		c.add(vBox, BorderLayout.CENTER);
		c.add(vBox);
		f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		f.setVisible(true);
	}

	private static class siteChoiceAction implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {
			String fieldSiteName = (String) fieldSite.getSelectedItem();
			fieldSiteChoiced.setText(fieldSiteName);
		}
	}

	private static class serviceChoiceAction implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {
			String fieldServiceName = (String) fieldService.getSelectedItem();
			fieldServiceChoiced.setText(fieldServiceName);
		}
	}

	private static class competenceChoiceAction implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {
			String fieldCompetenceName = (String) fieldCompetence.getSelectedItem();
			fieldCompetenceChoiced.setText(fieldCompetenceName);
		}
	}

	private static class BoutonListenerSearch implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {

			resultIdForUpdate = null;
			fieldMessage.setText("");
			fieldId.setText("");
			fieldSurname.setText("");
			fieldName.setText("");
			fieldPassword.setText("");
			fieldAddressNumber.setText("");
			fieldAddressLabel.setText("");
			fieldPostCode.setText("");
			fieldArea.setText("");
			fieldSiteChoiced.setText("");
			fieldServiceChoiced.setText("");
			fieldCompetenceChoiced.setText("");

			String pFieldMail = fieldMail.getText();

			systemPrintLn("TEXT : fieldMail    : " + pFieldMail);

			try {
				try {
//					Class.forName("com.mysql.jdbc.Driver");
					Class.forName("com.mysql.cj.jdbc.Driver");
				} catch (ClassNotFoundException e1) {
					e1.printStackTrace();
				}
				if (connexion == null) {
					connexion = DriverManager.getConnection(url, login, passwd);
				}

				if (connexion != null) {
					try {
						statement = connexion.createStatement();
						String sql = "SELECT u.* , s.name as siteName From usr u , site s where u.Email ='" + pFieldMail
								+ "' and u.discriminator = 'Volunteer' and u.siteid = s.id";
						systemPrintLn("sql :  " + sql);
						boolean bFound = false;
						resultMail = null;
						ResultSet resultat = statement.executeQuery(sql);
						while (resultat.next()) {
							bFound = true;
							systemPrintLn("trouvé");
							Integer resultId = resultat.getInt("id");
							resultIdForUpdate = resultId;
							String resultName = resultat.getString("Name");
							String resultSurname = resultat.getString("Surname");
							resultMail = resultat.getString("email");
							String resultPassword = resultat.getString("password");
							String resultAddressNumner = resultat.getString("numero");
							String resultAddressLabel = resultat.getString("rue");
							String resultPostCode = resultat.getString("postCode");
							String resultArea = resultat.getString("area");
							String resultSiteName = resultat.getString("siteName");

							systemPrintLn("BoutonListenerSearch () found  id    : " + resultId);
							systemPrintLn("BoutonListenerSearch () found  Name  : " + resultName);
							systemPrintLn("BoutonListenerSearch () found  email : " + resultMail);
							systemPrintLn("BoutonListenerSearch () found  rue : " + resultAddressLabel);

							// affichage données
							fieldName.setText(resultName);
							fieldSurname.setText(resultSurname);
							fieldPassword.setText(resultPassword);
							fieldAddressNumber.setText(resultAddressNumner);
							fieldAddressLabel.setText(resultAddressLabel);
							fieldPostCode.setText(resultPostCode);
							fieldArea.setText(resultArea);
							fieldId.setText(resultIdForUpdate.toString());
							fieldSiteChoiced.setText(resultSiteName);
							fieldServiceChoiced.setText(getServiceNameByUsrId(resultId));
							fieldCompetenceChoiced.setText(getCompetenceNameByUsrId(resultId));

							fieldMessage.setText("Mail : " + pFieldMail + " trouvé");

						}
						if (!bFound) {
							systemPrintLn("Mail : " + pFieldMail + "non trouvé dans la base");
							fieldName.setText("Inconnu");
							fieldSurname.setText("Inconnu");
							fieldPassword.setText("Inconnu");
							fieldAddressNumber.setText("Inconnu");
							fieldAddressLabel.setText("Inconnu");
							fieldPostCode.setText("Inconnu");
							fieldArea.setText("Inconnu");
							fieldMessage.setText("Le bénévole avec mail : '" + pFieldMail + "' n'existe pas en base");
						}
					} catch (SQLException e) {
						e.printStackTrace();
					} finally {
						try {
//							connexion.close();
							statement.close();
						} catch (SQLException e) {
							e.printStackTrace();
						}
					}
				}
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
	}

	// bouton de mise à jour
	private static class BoutonListenerUpdate implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {

			fieldMessage.setText("");
			if (resultIdForUpdate == null) {
				systemPrintLn("Before update : resultIdForUpdate = " + resultIdForUpdate);
				systemPrintLn("Before update : Il faut rechercher d'abord !! ");
				fieldMessage.setText("Il faut cliquer sur la recherche avec l'e-mail: " + fieldMail.getText());
				return;
			}

			String fieldNameForUpdate = fieldName.getText();
			String fieldSurnameForUpdate = fieldSurname.getText();
			String fieldMailForUpdate = fieldMail.getText();
			String fieldPasswordForUpdate = fieldPassword.getText();
			String fieldAddressNumberForUpdate = fieldAddressNumber.getText();
			String fieldAddressLabelForUpdate = fieldAddressLabel.getText();
			String fieldPostCodeForUpdate = fieldPostCode.getText();
			String fieldAreaForUpdate = fieldArea.getText();
			String fieldSiteChoicedForUpdate = fieldSiteChoiced.getText();
			String fieldServiceChoicedForUpdate = fieldServiceChoiced.getText();
			String fieldCompetenceChoicedForUpdate = fieldCompetenceChoiced.getText();

			systemPrintLn("Before update : resultIdForUpdate = " + resultIdForUpdate);

			if (resultIdForUpdate != null) {
				systemPrintLn("fieldNameForUpdate          : " + fieldNameForUpdate);
				systemPrintLn("fieldSurnameForUpdate       : " + fieldSurnameForUpdate);
				systemPrintLn("fieldMailForUpdate          : " + fieldMailForUpdate);
				systemPrintLn("fieldPasswordForUpdate      : " + fieldPasswordForUpdate);
				systemPrintLn("fieldAddressNumberForUpdate : " + fieldAddressNumberForUpdate);
				systemPrintLn("fieldAddressLabelForUpdate  : " + fieldAddressLabelForUpdate);
				systemPrintLn("fieldPostCodeForUpdate      : " + fieldPostCodeForUpdate);
				systemPrintLn("fieldAreaForUpdate          : " + fieldAreaForUpdate);

				// controle des champs
				boolean bOk = emptyFieldsControl();
				if (!bOk) {
					fieldMessage.setText("MERCI DE RENSEIGNER TOUS LES CHAMPS POUR LA MISE A JOUR DU BENEVOLE");
					return;
				}

				if (!lengthFieldsControl())
					return;
				//
				fieldMessage.setText("Mise à jour du bénévole " + fieldMailForUpdate + " en cours ...");

				try {
					try {
//						Class.forName("com.mysql.jdbc.Driver");
						Class.forName("com.mysql.cj.jdbc.Driver");
					} catch (ClassNotFoundException e1) {
						e1.printStackTrace();
					}
					connexion = DriverManager.getConnection(url, login, passwd);
					if (connexion != null) {
						try {
							systemPrintLn("BoutonListenerUpdate : go \n");

							statement = connexion.createStatement();

							// si le nouvel e-mail est différent,existe-t-il déjà ?

							if (resultMail != null && !resultMail.equals(fieldMailForUpdate)) {

								systemPrintLn(
										"resultMail : " + resultMail + " fieldMailForUpdate : " + fieldMailForUpdate);

								String sql = "SELECT count(*)  as nbr From fightfoodwaste.usr where Email ='"
										+ fieldMailForUpdate + "' and discriminator = 'Volunteer' and id <> "
										+ resultIdForUpdate;
								systemPrintLn("sql controle :  " + sql);
								Integer resultNbr = Integer.valueOf(0);
								ResultSet resultat = statement.executeQuery(sql);
								while (resultat.next()) {
									resultNbr = resultat.getInt("nbr");
								}
								if (resultNbr != 0) {
									systemPrintLn("Email : " + fieldMailForUpdate + " existe déjà. Update impossible");
									fieldMessage.setText(
											"Email : " + fieldMailForUpdate + " existe déjà. Mise à jour impossible");

									return;
								}
							}

							String sql = "UPDATE fightfoodwaste.usr SET ";
							sql += "siteId   = ( select id from site where name = '" + fieldSiteChoicedForUpdate
									+ "' ) , ";
							sql += "Name     = '" + fieldNameForUpdate + "' , ";
							sql += "Surname  = '" + fieldSurnameForUpdate + "' , ";
							sql += "Email    = '" + fieldMailForUpdate + "' , ";
							sql += "Password = '" + fieldPasswordForUpdate + "' , ";
							sql += "Numero   = '" + fieldAddressNumberForUpdate + "' , ";
							sql += "Rue      = '" + fieldAddressLabelForUpdate + "' , ";
							sql += "PostCode = '" + fieldPostCodeForUpdate + "' , ";
							sql += "Area     = '" + fieldAreaForUpdate + "' ";
							sql += "where ID = " + resultIdForUpdate;

							systemPrintLn("sql :  " + sql);
							int nbrLinesUpdate = statement.executeUpdate(sql);
							systemPrintLn("nbrLinesUpdate :  " + nbrLinesUpdate);
							statement.execute("commit");

							boolean bResultService = updateServiceForUsrIdAndServiceName(resultIdForUpdate,
									fieldServiceChoicedForUpdate);
							systemPrintLn("bResultService :  " + bResultService);

							boolean bResultCompetence = updateCompetenceForUsrIdAndCompetenceName(resultIdForUpdate,
									fieldCompetenceChoicedForUpdate);
							systemPrintLn("bResultCompetence :  " + bResultCompetence);

							fieldMessage.setText("Mise à jour du bénévole " + fieldMailForUpdate + " effectuée");

						} catch (SQLException e) {
							e.printStackTrace();
						} finally {
							try {
//								connexion.close();
								statement.close();
							} catch (SQLException e) {
								e.printStackTrace();
							}
						}
					}
				} catch (SQLException e) {
					e.printStackTrace();
				}
			}
		}
	}

	private static class BoutonListenerRAZ implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {
			RAZFields();
			systemPrintLn("RAZ all fields");
		}
	}

	//
	// bouton de création nouveau bénévole
	// une fois créé, il faut le relire pour avoir le resultIdForUpdate
	private static class BoutonListenerCreate implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {

			fieldMessage.setText("");
			resultIdForUpdate = null;

			String fieldNameForCreate = fieldName.getText();
			String fieldSurnameForCreate = fieldSurname.getText();
			String fieldMailForCreate = fieldMail.getText();
			String fieldPasswordForCreate = fieldPassword.getText();
			String fieldAddressNumberForCreate = fieldAddressNumber.getText();
			String fieldAddressLabelForCreate = fieldAddressLabel.getText();
			String fieldPostCodeForCreate = fieldPostCode.getText();
			String fieldAreaForCreate = fieldArea.getText();
			String fieldSiteChoicedForCreate = fieldSiteChoiced.getText();
			String fieldServiceChoicedForCreate = fieldServiceChoiced.getText();
			String fieldCompetenceChoicedForCreate = fieldCompetenceChoiced.getText();

			systemPrintLn("Before Create : resultIdForUpdate = " + resultIdForUpdate);

			systemPrintLn("fieldNameForCreate              : " + fieldNameForCreate);
			systemPrintLn("fieldSurnameForCreate           : " + fieldSurnameForCreate);
			systemPrintLn("fieldMailForCreate              : " + fieldMailForCreate);
			systemPrintLn("fieldPasswordForCreate          : " + fieldPasswordForCreate);
			systemPrintLn("fieldAddressNumberForCreate     : " + fieldAddressNumberForCreate);
			systemPrintLn("fieldAddressLabelForCreate      : " + fieldAddressLabelForCreate);
			systemPrintLn("fieldPostCodeForCreate          : " + fieldPostCodeForCreate);
			systemPrintLn("fieldAreaForCreate              : " + fieldAreaForCreate);
			systemPrintLn("fieldSiteChoicedForCreate       : " + fieldSiteChoicedForCreate);
			systemPrintLn("fieldServiceChoicedForCreate    : " + fieldServiceChoicedForCreate);
			systemPrintLn("fieldCompetenceChoicedForCreate : " + fieldCompetenceChoicedForCreate);

			// controle des champs
			boolean bOk = emptyFieldsControl();
			if (!bOk) {
				fieldMessage.setText("MERCI DE RENSEIGNER TOUS LES CHAMPS POUR LA CREATION DU BENEVOLE");
				return;
			}

			if (!lengthFieldsControl())
				return;

			//
			try {
				try {
//					Class.forName("com.mysql.jdbc.Driver");
					Class.forName("com.mysql.cj.jdbc.Driver");
				} catch (ClassNotFoundException e1) {
					e1.printStackTrace();
				}
				if (connexion == null) {
					connexion = DriverManager.getConnection(url, login, passwd);
				}
				if (connexion != null) {
					try {
						systemPrintLn("BoutonListenerUpdate : go \n");

						statement = connexion.createStatement();

						// le nouvel e-mail existe-t-il déjà ?

						systemPrintLn("fieldMailForCreate : " + fieldMailForCreate);

						String sqlCtrl = "SELECT count(*)  as nbr From fightfoodwaste.usr where Email ='"
								+ fieldMailForCreate + "' and discriminator = 'Volunteer' ";
						systemPrintLn("sql controle create :  " + sqlCtrl);
						Integer resultNbr = Integer.valueOf(0);
						ResultSet resultat = statement.executeQuery(sqlCtrl);
						while (resultat.next()) {
							resultNbr = resultat.getInt("nbr");
						}
						if (resultNbr != 0) {
							systemPrintLn("Email : " + fieldMailForCreate + " existe déjà. Création impossible");
							fieldMessage.setText("Email : " + fieldMailForCreate + " existe déjà. Création impossible");
							return;
						}
						System.out
								.println("Email : " + fieldMailForCreate + " n'existe pas. Création bénévole en cours");

						String sql = "insert into usr  ( siteId , email , name, surname, password ,";
						sql += " numero ,rue ,postCode, Area, Eligibility, Siret,Salary, Discriminator)";
						sql += " values ( ";
						sql += " (select id from site where name = '" + fieldSiteChoicedForCreate + "')" + ", '"
								+ fieldMailForCreate + "' , ";
						sql += " '" + fieldNameForCreate + "' , ";
						sql += " '" + fieldSurnameForCreate + "' , ";
						sql += " '" + fieldPasswordForCreate + "' , ";
						sql += " '" + fieldAddressNumberForCreate + "' , ";
						sql += " '" + fieldAddressLabelForCreate + "' , ";
						sql += " '" + fieldPostCodeForCreate + "' , ";
						sql += " '" + fieldAreaForCreate + "' , ";
						sql += " 0 , null, 0.0 , 'Volunteer'";
						sql += " )";

						systemPrintLn("sql create :  " + sql);
						statement.execute(sql);
						statement.execute("commit");
						systemPrintLn("insert successfull");
						fieldMessage.setText("Création nouveau bénévole " + fieldMailForCreate + " OK");
						//
						// relecture pour avoir resultIdForUpdate
						// pour qu'on puisse faire des modif dans la foulée.
						try {
							String sqlSearch = "SELECT * From fightfoodwaste.usr where Email ='" + fieldMailForCreate
									+ "' and discriminator = 'Volunteer' ";
							ResultSet resultatSearch = statement.executeQuery(sqlSearch);
							while (resultatSearch.next()) {
								Integer resultIdSearchId = resultatSearch.getInt("id");
								resultIdForUpdate = resultIdSearchId;
								fieldId.setText(resultIdForUpdate.toString());
							}

							boolean bResultService = updateServiceForUsrIdAndServiceName(resultIdForUpdate,
									fieldServiceChoicedForCreate);
							systemPrintLn("bResultService :  " + bResultService);

							boolean bResultCompetence = updateCompetenceForUsrIdAndCompetenceName(resultIdForUpdate,
									fieldCompetenceChoicedForCreate);
							systemPrintLn("bResultCompetence :  " + bResultCompetence);

						} catch (SQLException e) {
							fieldMessage.setText("Problème lors de la relecture après création");
							e.printStackTrace();
						}
					} catch (SQLException e) {
						e.printStackTrace();
					} finally {
						try {
							statement.close();
						} catch (SQLException e) {
							e.printStackTrace();
						}
					}
				}
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
	}

	private static boolean updateServiceForUsrIdAndServiceName(Integer usrId, String serviceName) {
		boolean bResult = true;

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion updateServiceForUsrIdAndServiceName not null");

					statement = connexion.createStatement();
					String sql = "DELETE from affectation where UsrId = " + usrId;
					statement.execute(sql);
					statement.execute("commit");

					sql = "INSERT INTO affectation ( serviceId, usrId)  values ( (select id from service where name = '"
							+ serviceName + "') ," + usrId + ")";
					systemPrintLn("sql maj service : " + sql);
					statement.execute(sql);
					statement.execute("commit");

				} catch (SQLException e) {
					bResult = false;
					e.printStackTrace();
				} finally {
					try {
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return bResult;
	}

	private static boolean updateCompetenceForUsrIdAndCompetenceName(Integer usrId, String competenceName) {
		boolean bResult = true;

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion updateCompetenceForUsrIdAndServiceName not null");

					statement = connexion.createStatement();
					String sql = "DELETE from justificatif where UsrId = " + usrId;
					statement.execute(sql);
					statement.execute("commit");

					sql = "INSERT INTO justificatif ( link , competenceId, usrId)  values ( null, (select id from competence where name = '"
							+ competenceName + "') ," + usrId + ")";
					systemPrintLn("sql maj justificatif : " + sql);
					statement.execute(sql);
					statement.execute("commit");

				} catch (SQLException e) {
					bResult = false;
					e.printStackTrace();
				} finally {
					try {
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return bResult;
	}

	private static Object[] construireListeSites() {
		Object[] listeSites = null;

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion Sites not null");

					statement = connexion.createStatement();
					String sql = "SELECT count(*)  as nbr From fightfoodwaste.site ";
					Integer nbrSite = Integer.valueOf(0);
					ResultSet resultat = statement.executeQuery(sql);
					while (resultat.next()) {
						nbrSite = resultat.getInt("nbr");
					}
					if (nbrSite > 0) {
						listeSites = new Object[nbrSite];
						sql = "SELECT name From fightfoodwaste.site ";
						resultat = statement.executeQuery(sql);
						int i = 0;
						while (resultat.next()) {
							String name = resultat.getString("name");
							listeSites[i++] = name;
						}
					}
				} catch (SQLException e) {
					e.printStackTrace();
				} finally {
					try {
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return listeSites;
	}

	private static Object[] construireListeServices() {

		Object[] listeServices = null;

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion Service not null");

					statement = connexion.createStatement();
					String sql = "SELECT count(*)  as nbr From fightfoodwaste.service ";
					Integer nbrServices = Integer.valueOf(0);
					ResultSet resultat = statement.executeQuery(sql);
					while (resultat.next()) {
						nbrServices = resultat.getInt("nbr");
					}
					systemPrintLn("nbrServices : " + nbrServices);
					if (nbrServices > 0) {
						listeServices = new Object[nbrServices];
						sql = "SELECT name From fightfoodwaste.service ";
						resultat = statement.executeQuery(sql);
						int i = 0;
						while (resultat.next()) {
							String name = resultat.getString("name");
							listeServices[i++] = name;
						}
					}
				} catch (SQLException e) {
					e.printStackTrace();
				} finally {
					try {
//						connexion.close();
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return listeServices;
	}

	private static Object[] construireListeCompetences() {

		Object[] listeCompetences = null;

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion Competences not null");

					statement = connexion.createStatement();
					String sql = "SELECT count(*)  as nbr From fightfoodwaste.competence ";
					Integer nbrCompetences = Integer.valueOf(0);
					ResultSet resultat = statement.executeQuery(sql);
					while (resultat.next()) {
						nbrCompetences = resultat.getInt("nbr");
					}
					systemPrintLn("nbrCompetences : " + nbrCompetences);
					if (nbrCompetences > 0) {
						listeCompetences = new Object[nbrCompetences];
						sql = "SELECT name From fightfoodwaste.competence ";
						resultat = statement.executeQuery(sql);
						int i = 0;
						while (resultat.next()) {
							String name = resultat.getString("name");
							listeCompetences[i++] = name;
						}
					}
				} catch (SQLException e) {
					e.printStackTrace();
				} finally {
					try {
//						connexion.close();
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return listeCompetences;
	}

	private static String getServiceNameByUsrId(Integer usrId) {
		String serviceName = "";

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion getServiceNameByUsrId not null");

					statement = connexion.createStatement();
					String sql = "SELECT serv.name as name From affectation aff , service serv where aff.usrId = "
							+ usrId + " and aff.serviceId  = serv.id ";

					ResultSet resultat = statement.executeQuery(sql);
					while (resultat.next()) {
						serviceName = resultat.getString("name");
					}
				} catch (SQLException e) {
					e.printStackTrace();
				} finally {
					try {
//						connexion.close();
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return serviceName;
	}

	private static String getCompetenceNameByUsrId(Integer usrId) {
		String competenceName = "";

		try {
			try {
//				Class.forName("com.mysql.jdbc.Driver");
				Class.forName("com.mysql.cj.jdbc.Driver");
			} catch (ClassNotFoundException e1) {
				e1.printStackTrace();
			}
			if (connexion == null) {
				connexion = DriverManager.getConnection(url, login, passwd);
			}
			if (connexion != null) {
				try {
					systemPrintLn("connexion getServiceNameByUsrId not null");

					statement = connexion.createStatement();
					String sql = "SELECT com.name as name From justificatif jus , competence com where jus.usrId = "
							+ usrId + " and jus.competenceId = com.id ";

					ResultSet resultat = statement.executeQuery(sql);
					while (resultat.next()) {
						competenceName = resultat.getString("name");
					}
				} catch (SQLException e) {
					e.printStackTrace();
				} finally {
					try {
//						connexion.close();
						statement.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}
				}
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return competenceName;
	}

	private static void RAZFields() {
		fieldSurname.setText("");
		fieldName.setText("");
		fieldMail.setText("");
		fieldPassword.setText("");
		fieldAddressNumber.setText("");
		fieldAddressLabel.setText("");
		fieldPostCode.setText("");
		fieldArea.setText("");
		fieldMessage.setText("");
		fieldId.setText("");
		fieldSiteChoiced.setText("");
		fieldServiceChoiced.setText("");
		fieldCompetenceChoiced.setText("");
	}

	private static boolean emptyFieldsControl() {
		boolean bOk = true;
		if (fieldName.getText() == null || fieldName.getText().length() <= 0)
			bOk = false;

		if (fieldSurname.getText() == null || fieldSurname.getText().length() <= 0)
			bOk = false;

		if (fieldMail.getText() == null || fieldMail.getText().length() <= 0)
			bOk = false;

		if (fieldPassword.getText() == null || fieldPassword.getText().length() <= 0)
			bOk = false;

		if (fieldAddressNumber.getText() == null || fieldAddressNumber.getText().length() <= 0)
			bOk = false;

		if (fieldAddressLabel.getText() == null || fieldAddressLabel.getText().length() <= 0)
			bOk = false;

		if (fieldPostCode.getText() == null || fieldPostCode.getText().length() <= 0)
			bOk = false;

		if (fieldArea.getText() == null || fieldArea.getText().length() <= 0)
			bOk = false;

		if (fieldSiteChoiced.getText() == null || fieldSiteChoiced.getText().length() <= 0)
			bOk = false;

		if (fieldServiceChoiced.getText() == null || fieldServiceChoiced.getText().length() <= 0)
			bOk = false;

		if (fieldCompetenceChoiced.getText() == null || fieldCompetenceChoiced.getText().length() <= 0)
			bOk = false;

		return bOk;
	}

	private static boolean lengthFieldsControl() {
		if (fieldName.getText() != null && fieldName.getText().length() > 80) {
			fieldMessage.setText("Le champ prénom ne doit pas dépasser 80 caractères");
			return false;
		}

		if (fieldSurname.getText() != null && fieldSurname.getText().length() > 80) {
			fieldMessage.setText("Le champ nom ne doit pas dépasser 80 caractères");
			return false;
		}

		if (fieldMail.getText() != null && fieldMail.getText().length() > 255) {
			fieldMessage.setText("Le champ e-mail ne doit pas dépasser 255 caractères");
			return false;
		}

		if (fieldPassword.getText() != null && fieldPassword.getText().length() > 200) {
			fieldMessage.setText("Le champ mot de passe ne doit pas dépasser 200 caractères");
			return false;
		}

		if (fieldAddressNumber.getText() != null && fieldAddressNumber.getText().length() > 5) {
			fieldMessage.setText("Le champ numéro rue ne doit pas dépasser 5 caractères");
			return false;
		}

		if (fieldAddressLabel.getText() != null && fieldAddressLabel.getText().length() > 80) {
			fieldMessage.setText("Le champ adresse rue ne doit pas dépasser 80 caractères");
			return false;
		}

		if (fieldPostCode.getText() != null && fieldPostCode.getText().length() > 5) {
			fieldMessage.setText("Le code postal ne doit pas dépasser 5 caractères");
			return false;
		}

		if (fieldArea.getText() != null && fieldArea.getText().length() > 80) {
			fieldMessage.setText("Le nom ville ne doit pas dépasser 80 caractères");
			return false;
		}

		return true;
	}

	private static void systemPrintLn(String message) {
		if (isDebug) {
			System.out.println(message);
		}
	}
}