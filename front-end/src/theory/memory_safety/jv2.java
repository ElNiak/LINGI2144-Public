import java.lang.reflect.Field;
class SecureData {   
    private String password = "MySecretPassword";
}
public class SecuredDataHack {
    public static void main(String[] args) throws Exception {
        SecureData s = SecureData.class.newInstance();   
        Field f[] = s.getClass().getDeclaredFields();   
        f[0].setAccessible(true);   
        Object pass = new Object();   
        pass = f[0].get(s);   
        System.out.println("Here is your " + f[0].getName() + " : " + pass );   
        f[0].set(s, "NewPassword");   
        pass = f[0].get(s);   
        System.out.println("Here is new " + f[0].getName() + " : " + pass );

    }
}
/**
axel@axel-VirtualBox:~/javamerde$ java SecuredDataHack 
Here is your password : MySecretPassword
Here is new password : NewPassword
 */