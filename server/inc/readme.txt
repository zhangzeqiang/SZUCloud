这里的model类负责接口
1、将../core中的adapt类继承为model类
2、包括对应的model文件目录下所有需要使用到的功能类文件

然后如果在model文件目录中添加新的功能类文件时，只需保证model文件有包括它
然后在model目录中新的功能类文件中便可以直接使用model文件

注意点:inc目录外的文件要使用到功能类时，请直接require_once("**model.class.php")
然后有新功能类添加时，请在**model.class.php中直接添加require_once(**/功能类文件);