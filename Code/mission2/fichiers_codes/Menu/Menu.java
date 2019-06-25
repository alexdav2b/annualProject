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

public class Menu extends JFrame {

	private static JComboBox<Object> fieldListMenus = null;
	private static JTextField fieldListIngredients = new JTextField(100);

	private static Connection connexion = null;
	private static Statement statement = null;

	private static final String url = "jdbc:mysql://137.74.118.225:3306/fightfoodwaste?useTimezone=true&serverTimezone=UTC";
	private static final String login = "website"; // Un admin de la base : root
	private static final String passwd = "website"; // éventuel un pwd d'administration

	private static ActionListener fieldIngredientActionListener = new fieldIngredientAction();

	private static final boolean isDebug = false;

	@SuppressWarnings("unchecked")
	public static void main(String argv[]) {

		JFrame f = new JFrame("Propositions de menus");
		f.setSize(500, 300); // largueur , hauteur
		f.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE);
		Dimension dim = Toolkit.getDefaultToolkit().getScreenSize();
		f.setLocation(dim.width / 2 - f.getWidth() / 2, dim.height / 2 - f.getHeight() / 2);

		// liste des menu-recette

		Box hBox1 = Box.createHorizontalBox();
		fieldListMenus = new JComboBox<Object>(construireListeMenus());
		fieldListMenus.setMaximumSize(fieldListMenus.getPreferredSize());
		JLabel labelSite = new JLabel("Menus possibles : ", SwingConstants.LEFT);
//		ActionListener fieldIngredientActionListener = new fieldIngredientAction();
		fieldListMenus.addActionListener(fieldIngredientActionListener);

		hBox1.add(labelSite);
		hBox1.add(Box.createHorizontalStrut(5));
		hBox1.add(fieldListMenus);

		// Liste ingrédients du menu choisi
		Box hBox2 = Box.createHorizontalBox();
		fieldListIngredients.setEditable(false);
		JLabel labelFieldListIngredients = new JLabel("Liste ingrédients : ", SwingConstants.LEFT);
		fieldListIngredients.setMaximumSize(fieldListIngredients.getPreferredSize());
		hBox2.add(labelFieldListIngredients);
		hBox2.add(Box.createHorizontalStrut(5));
		hBox2.add(fieldListIngredients);

		// RAZ liste de menus
		Box hBox3 = Box.createHorizontalBox();
		JButton buttonRAZ = new JButton("RAZ liste des menus");
		buttonRAZ.addActionListener(new BoutonListenerRAZList());
		hBox3.add(buttonRAZ);
		hBox3.add(Box.createGlue());

		JButton buttonConstructList = new JButton("Construire la liste des menus");
		buttonConstructList.addActionListener(new BoutonListenerCreateList());
		hBox3.add(buttonConstructList);

		// assemblage des Box
		Box vBox = Box.createVerticalBox();
		vBox.add(hBox1);
		vBox.add(hBox2);
		vBox.add(hBox3);

		Container c = f.getContentPane();
		c.add(vBox);
		f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		f.setVisible(true);
	}

	private static Object[] construireListeMenus() {

		Object[] listeMenus = null;

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
					systemPrintLn("connexion Menus not null");

					statement = connexion.createStatement();
					String sql = "select count(*) as nbr from ( ";
					sql += "select distinct rec.type , rec.name as recette ";
					sql += "from recipee rec , quantity qua , ingredient ing , instock ins , product pro ";
					sql += "where  qua.recipeeId  = rec.id ";
					sql += "and qua.ingredientId = ing.id ";
					sql += "and ins.ingredientId= ing.id ";
					sql += "and ins.productId = pro.id ) as sel ";

					Integer nbrMenus = Integer.valueOf(0);
					ResultSet resultat = statement.executeQuery(sql);
					while (resultat.next()) {
						nbrMenus = resultat.getInt("nbr");
					}
					systemPrintLn("nbrMenus : " + nbrMenus);

					if (nbrMenus > 0) {
						listeMenus = new Object[nbrMenus];

						sql = " select  distinct rec.type , rec.name as recette  from recipee rec ,";
						sql += " quantity qua , ingredient ing , instock ins , product pro ";
						sql += " where  qua.recipeeId  = rec.id ";
						sql += "and qua.ingredientId = ing.id ";
						sql += "and ins.ingredientId= ing.id ";
						sql += "and ins.productId = pro.id ";
						sql += "order by  rec.type , rec.name ";

						resultat = statement.executeQuery(sql);
						int i = 0;
						while (resultat.next()) {
							String type = resultat.getString("type");
							String finalType = "";
							String recette = resultat.getString("recette");
							if ("E".equals(type))
								finalType = "(Entrée)";
							if ("P".equals(type))
								finalType = "(Plat)";
							if ("D".equals(type))
								finalType = "(Dessert)";
							listeMenus[i++] = recette + " " + finalType;
						}
						fieldListIngredients.setText("");
						systemPrintLn("listeMenus.length : " + listeMenus.length);
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

		return listeMenus;
	}

	private static class fieldIngredientAction implements ActionListener {

		@SuppressWarnings("unchecked")
		@Override
		public void actionPerformed(ActionEvent arg0) {
			JComboBox<String> cb = (JComboBox<String>) arg0.getSource();
			String fieldListMenusChoicedName = (String) cb.getSelectedItem();
			int selectedIndex = fieldListMenus.getSelectedIndex();
			fieldListIngredients.setText("");

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
				if (connexion != null && fieldListMenusChoicedName != null && fieldListMenusChoicedName.length() > 0) {
					try {
						systemPrintLn("fieldListMenusChoicedName : " + fieldListMenusChoicedName);

						int posit = fieldListMenusChoicedName.indexOf('(');
						String finalfieldListMenusChoicedName = fieldListMenusChoicedName.substring(0, posit - 1);
						systemPrintLn("selectedIndex : " + selectedIndex + " fieldListMenusChoicedName : "
								+ fieldListMenusChoicedName + " finalfieldListMenusChoicedName  : "
								+ finalfieldListMenusChoicedName);

						statement = connexion.createStatement();
						String sqlCount = "select count(*) as nbrIngredientCount from ( select rec.name as recName, ing.name as ingName ";
						sqlCount += "  from recipee rec, ingredient ing  , quantity qua  where  rec.name= '"
								+ finalfieldListMenusChoicedName + "'";
						sqlCount += " and rec.id = qua.RecipeeID and qua.ingredientID =ing.id ) as ingCount ";

						Integer nbrIngredientCount = Integer.valueOf(0);
						ResultSet resultat = statement.executeQuery(sqlCount);
						while (resultat.next()) {
							nbrIngredientCount = resultat.getInt("nbrIngredientCount");
						}
						systemPrintLn("nbrIngredientCount : " + nbrIngredientCount);

						if (nbrIngredientCount > 0) {
							String sqlingredient = "select rec.name as recName , ing.name as ingName from recipee rec, ingredient ing , quantity qua where ";
							sqlingredient += "rec.name= '" + finalfieldListMenusChoicedName
									+ "' and rec.id = qua.RecipeeID and qua.ingredientID =ing.id  ";

							systemPrintLn("sqlingredient : " + sqlingredient);

							resultat = statement.executeQuery(sqlingredient);

							String finalList = "";
							int i = 0;
							while (resultat.next()) {
								String recName = resultat.getString("recName");
								String ingName = resultat.getString("ingName");
								if (i == 0) {
									finalList = "Il faut : " + ingName;
								} else {
									finalList += ", " + ingName;
								}
								i++;
							}
							fieldListIngredients.setText(finalList);
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

	private static class BoutonListenerCreateList implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {

			systemPrintLn("BoutonListenerCreateList start");
			fieldListMenus.removeAllItems();
			Object[] listeMenus = construireListeMenus();
			if (listeMenus != null && listeMenus.length > 0) {
				for (int i = 0; i < listeMenus.length; i++) {
					fieldListMenus.addItem((Object) listeMenus[i]);
				}
			}
			fieldListMenus.setVisible(true);
			systemPrintLn("BoutonListenerCreateList end");
		}
	}

	private static class BoutonListenerRAZList implements ActionListener {

		@Override
		public void actionPerformed(ActionEvent arg0) {

			systemPrintLn("BoutonListenerRAZList start");
			fieldListMenus.removeAllItems();
			fieldListMenus.setVisible(true);
			fieldListIngredients.setText("");
			systemPrintLn("BoutonListenerRAZList end");
		}
	}

	private static void systemPrintLn(String message) {
		if (isDebug) {
			System.out.println(message);
		}
	}

}