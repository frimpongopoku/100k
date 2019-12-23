package Bus;

import java.util.ArrayList;
import java.util.List;
import java.util.HashMap;



public class LevelConstants {
	private static int INFINITE = -1;

	/*
	 *  = { levelConstant, defaultFolderAllowance, defaultImageAllowance };
	 * 
	 */
	
	public static int[] TYPE_A_LEVEL_INFO = {1,INFINITE,6}; 
	public static int[] TYPE_B_LEVEL_INFO = {3,20,3}; 
	public static int[] TYPE_C_LEVEL_INFO = {5,10,2}; 
	public static int[][] levelInformation = {TYPE_A_LEVEL_INFO,TYPE_B_LEVEL_INFO,TYPE_C_LEVEL_INFO};

}
