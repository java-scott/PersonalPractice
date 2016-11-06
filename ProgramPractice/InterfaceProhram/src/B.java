/**
 * User: scott
 * Date: 2016/11/6
 * Time: 10:14
 */
public class B extends A {
    String x = "java";

    @Override
    public String toString() {
        return str + x + " and" + super.x;
    }
}
