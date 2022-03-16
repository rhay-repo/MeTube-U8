/* behavioral simulation of the simple machine described by Richard Eckert 
 * in "Micro-programmed versus hardwired control units: How computers really
 * work" - URL is http://www.cs.binghamton.edu/~reckert/hardwire3new.html
 *
 * used as example simulator code in CPSC 3300 at Clemson
 *
 * modified:
 *  read input file from stdin
 *  print cycle-by-cycle when enabled by a verbose flag
 *  track and print execution statistics
 *
 * this code simulates the instruction set of Eckert's simple machine but
 * does not show the cycle-by-cycle operations
 *
 * the instructions and data for the simple machine are read as hex values
 * from a file named "ram.txt" in the current directory
 *
 * instructions implemented:
 *   lda - load accumulator, coded as 1xx, where xx is the operand address
 *   sta - store accumulator, coded as 2xx, where xx is the destination
 *           address
 *   add - add value in b register to accumulator, coded as 3yy, where yy
 *           is ignored
 *   sub - subtract value in b register from accumulator, coded as 4yy,
 *           where yy is ignored
 *   mba - make b register same as accumulator (i.e., copy the value in the
 *           accumulator into the b register), coded as 5yy, where yy is
 *           ignored
 *   jmp - unconditional jump, coded as 6xx, where xx is the branch target
 *           address
 *   jn (jneg) - conditional jump, coded as 7xx, where xx is the branch
 *                 target address
 *   hlt - halt, coded as any value 800 to fff, inclusive
 *
 * the program starts execution at address zero
 *
 * an opcode of 0 generates an error message and an exit from the simulator
 *
 * the contents of memory are echoed as they are read in before the simulation
 * begins; the contents are also displayed when a halt instruction is executed
 * so that the changes to memory words caused by store instructions can be
 * verified
 *
 * a simple program to find the difference of two numbers, c = a - b, is:
 *   107    // 0: lda b
 *   500    // 1: mba
 *   106    // 2: lda a
 *   400    // 3: sub
 *   208    // 4: sta c
 *   800    // 5: hlt
 *   5      // 6: a: word 5
 *   2      // 7: b: word 2
 *   0      // 8: c: word 0 - should end up as 3
 */


#include<stdio.h>
#include<stdlib.h>

/* registers and memory - represented by 32-bit int data type even though */
/*   most registers and memory have a 12-bit word size; note that the pc  */
/*   and mar hold 8-bit addresses only */

int halt     = 0, /* halt flag to halt the simulation */
    pc       = 0, /* program counter register, abbreviated as p */
    mar      = 0, /* memory address register, abbreviated as m */
    ram[256],     /* main memory to hold instructions and data */
    mdr      = 0, /* memory data register, abbreviated as d */
    acc      = 0, /* accumulator register, abbreviated as a */
    alu_tmp  = 0, /* called "ALU" register in the paper, abbreviated as u */
    b        = 0, /* b register to hold second operand for add/subtract */
    ir       = 0; /* instruction register, abbreviated as i */

int word_count;  /* indicates how many memory words to display at end */
int verbose = 0; /* flag to control printing of cycle-by-cycle results */

/* dynamic execution counters */
int inst_fetch_cnt = 0,
    inst_cnt[8] = {0},
    jneg_taken_cnt = 0,
    mem_read_cnt = 0,  /* for this simple machine, equals lda inst cnt */
    mem_write_cnt = 0; /* for this simple machine, equals sta inst cnt */


/* initialization routine to read in memory contents */

void load_ram(){
  int i = 0;

  if( verbose ){
    printf( "contents of RAM memory\n" );
    printf( "addr value\n" );
  }
  while( scanf( "%x", &ram[i] ) != EOF ){
    if( i >= 256 ){
      printf( "ram.txt program file overflows available RAM\n" );
      exit( -1 );
    }
    ram[i] = ram[i] & 0xfff; /* clamp to 12-bit word size */
    if( verbose ) printf( " %2x:  %03x\n", i, ram[i] );
    i++;
  }
  word_count = i;
  for( ; i < 256; i++ ){
    ram[i] = 0;
  }
  if( verbose ) printf( "\n" );
}


/* instruction fetch routine */

void fetch(){
  mar = pc;
  mdr = ram[ mar ];
  ir = mdr;
  pc++;

  inst_fetch_cnt++;
}


/* set of instruction execution routines - these use the step-by-step    */
/*   register transfers shown in the paper rather than single assignment */
/*   statements as would be typical for behavioral simulation */

void inv(){
  printf( "invalid opcode\n" );
  exit( -1 );
}

void lda(){
  mar = ir & 0xff; /* clamp to 8-bit address */
  mdr = ram[ mar ];
  acc = mdr;

  mem_read_cnt++;
}

void sta(){
  mar = ir & 0xff; /* clamp to 8-bit address */
  mdr = acc;
  ram[ mar ] = mdr;

  mem_write_cnt++;
}

void add(){
  alu_tmp = ( acc + b ) & 0xfff; /* clamp to 12-bit word size */
  acc = alu_tmp;
}

void sub(){
  alu_tmp = ( acc - b ) & 0xfff; /* clamp to 12-bit word size */
  acc = alu_tmp;
}

void mba(){
  b = acc;
}

void jmp(){
  pc = ir & 0xff; /* clamp to 8-bit address */
}

void jneg(){
  if( acc >> 11 ){
    pc = ir & 0xff; /* clamp to 8-bit address */

    jneg_taken_cnt++;
  }
}

void hlt(){
  halt = 1;
}


/* instruction decode routine - uses an array of function pointers with  */
/*   the opcode as the index into the array; an alternate approach is to */
/*   use a switch statement, perhaps in the main program itself with the */
/*   case labels and break statements bracketing instruction execution   */
/*   statements - thereby avoiding function calls */

void ( * fnp[8] )() = { inv, lda, sta, add, sub, mba, jmp, jneg };

void ( *decode() ) (){
  int opcode = ( ir >> 8 ) & 0xf; /* clamp to 4-bit opcode field */
  if( ( opcode >= 0 ) && ( opcode <= 7 ) ){

    inst_cnt[opcode]++;

    return fnp[opcode];
  }else{
    return hlt;
  }
}


/* main program */

int main( int argc, char **argv ){
  void ( *inst )();
  int i;

  if( argc > 1 ){
    if( ( argv[1][0] == '-' ) &&
        (( argv[1][1] == 'v' ) || ( argv[1][1] == 'V' )) ){

      verbose = 1;

    }else{
      printf( "usage: either %s or %s -v with input taken from stdin\n",
        argv[0], argv[0] );
      exit( -1 );
    }
  }
      

  printf( "\nbehavioral simulation of Eckert's simple machine\n" );
  if( verbose ){
    printf( "(register and memory values are shown in hexadecimal)\n\n" );
  }

  load_ram();

  if( verbose ){
    printf( "intial register values\n" );
    printf( " pc mar mdr acc alu   b  ir\n" );
    printf( "%3x %3x %3x %3x %3x %3x %3x\n\n",
      pc, mar, mdr, acc, alu_tmp, b, ir );

    printf( "register values after each instruction has been executed\n" );
    printf( " pc mar mdr acc alu   b  ir\n" );
  }

  while( !halt ){

    fetch();

    inst = decode();

    ( *inst )();

    if( verbose) printf( "%3x %3x %3x %3x %3x %3x %3x\n",
      pc, mar, mdr, acc, alu_tmp, b, ir );
  }

  if( verbose ){
    printf( "\ncontents of RAM memory\n" );
    printf( "addr value\n" );
    for( i = 0; i < word_count; i++ ){
      printf( " %2x:  %03x\n", i, ram[i] );
    }
    printf( "\n" );
  }

  printf( "execution statistics\n" );
  printf( "  instruction fetches = %d\n", inst_fetch_cnt );
  printf( "    lda instructions  = %d\n", inst_cnt[1] );
  printf( "    sta instructions  = %d\n", inst_cnt[2] );
  printf( "    add instructions  = %d\n", inst_cnt[3] );
  printf( "    sub instructions  = %d\n", inst_cnt[4] );
  printf( "    mba instructions  = %d\n", inst_cnt[5] );
  printf( "    jmp instructions  = %d\n", inst_cnt[6] );
  printf( "    jneg instructions = %d",   inst_cnt[7] );
  if( inst_cnt[7] > 0 ){
    printf( ", taken = %d (%.1f%%)\n", jneg_taken_cnt,
      100.0*((float)jneg_taken_cnt)/((float)inst_cnt[7]) );
  }else{
    printf("\n");
  }
  printf( "  memory data reads   = %d\n", mem_read_cnt );
  printf( "  memory data writes  = %d\n", mem_write_cnt );

  return 0;
}
