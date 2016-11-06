/**
 * User: scott
 * Date: 2016/11/6
 * Time: 09:36
 */
public class Student {

    private Long id;

    private String studentNum;

    private String studentName;

    private String studentAge;

    private String studentMajor;

    private String studentGradle;

    /**
     *
     */
    public Student() {
        super();
    }

    /**
     * getter setter方法
     * @param id
     */
    public void setId(Long id) {
        this.id = id;
    }

    public void setStudentNum(String studentNum) {
        this.studentNum = studentNum;
    }

    public void setStudentName(String studentName) {
        this.studentName = studentName;
    }

    public void setStudentAge(String studentAge) {
        this.studentAge = studentAge;
    }

    public void setStudentMajor(String studentMajor) {
        this.studentMajor = studentMajor;
    }

    public void setStudentGradle(String studentGradle) {
        this.studentGradle = studentGradle;
    }

    public Long getId() {
        return id;
    }

    public String getStudentNum() {
        return studentNum;
    }

    public String getStudentName() {
        return studentName;
    }

    public String getStudentAge() {
        return studentAge;
    }

    public String getStudentMajor() {
        return studentMajor;
    }

    public String getStudentGradle() {
        return studentGradle;
    }


    /**
     * 构造函数
     * 初始化学生类中的属性信息
     * @param id
     * @param studentNum
     * @param studentName
     * @param studentAge
     * @param studentMajor
     * @param studentGradle
     */
    public Student(Long id, String studentNum, String studentName, String studentAge, String studentMajor, String studentGradle) {
        this.id = id;
        this.studentNum = studentNum;
        this.studentName = studentName;
        this.studentAge = studentAge;
        this.studentMajor = studentMajor;
        this.studentGradle = studentGradle;
    }

    /**
     * 定义方法Display，用于输出学生信息
     */
    public void Display() {
        System.out.println("学号：" + studentNum + "\n" + "姓名：" + studentName + "\n" + "年龄：" + studentAge +
        "\n" + "专业：" + studentMajor + "\n" + "年级：" + studentGradle);
    }


}

