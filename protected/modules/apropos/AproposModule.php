<?php
/**
 * @TODO:
 * 1. Fix spelling https://habr.com/ru/company/yandex/blog/231495/
 * 2. Dublicator: Add action that
 *      - Merges content from 1 files to another
		$extraOptions = [
			'femaleactor_apbedmissionary' => 'femaleactor_fdbedmissionary',
			'femaleactor_leitokissing'    => 'femaleactor_leitokissing2',
			'femaleactor_goat'            => 'femaleactor_goatvag',
			'femaleactor_zynmissionary'   => 'femaleactor_fdbedmissionary',
		];
 *      - Copies some stages to different folders and replaces fixed list of words
 *		  for example horse oral to bear oral
 * 3. https://github.com/dejurin/php-google-translate-for-free
 * 4. Check Female_FemaleActor and FemaleActor_Female
 * 2. Fixator:
 *      - Replace {ACTIVE} {PRIMARY} from 3rd persons to Он/Она, Она/Он
 * ========================================================================
 * 1. fixed json bugs
 * 2. fixed grammar bugs (invalid brackets, punctuation marks, invalid spaces, removed empty lines)
 * 
 * 
 * db-dst
 *     # [v1] original (amlgames.com/mods-assemblies/author-assemblies/thorne-assemblies/seksrim-sse-60-leto-zimaosen-zima-bolshaya-sborka-obychnyh-i-seks-modov-r21)
 *     db-1-1-1 - fixed json bugs
 *     db-1-1-2 - fixed grammar bugs (invalid brackets, punctuation marks, invalid spaces, aligns)
 *     db-1-1-3 - fixed spelling bugs (Yandex Spelling service correction)
 *     db-1-1-4 - fixed descriptors bugs (invalid descriptors)
 * 
 *	   # [v2-merged-to-v1] extended merged version v2 to v1
 *     db-1-2-1 - merged v2 to v1 (similar text, merge files, max 6 stages)
 *     db-1-2-2 - merged v2 configs to v1 ()
 * 
 *     db-0-2   - separate v2 on en and ru files
 * 
 *     # [v2] only russian files (amlgames.com/forums/topic/662-perevod-apropos-2)
 *	   db-2-1-1 - fixed json bugs
 *     db-2-1-2 - fixed grammar bugs (invalid brackets, punctuation marks, invalid spaces, aligns)
 *     db-2-1-3 - fixed spelling bugs (Yandex Spelling service correction)
 * 
 *     # [v2] only english files (amlgames.com/forums/topic/662-perevod-apropos-2)
 *     db-2-2-1 - fixed json bugs
 *     db-2-2-2 - fixed grammar bugs (invalid brackets, punctuation marks, invalid spaces, aligns)
 *     db-2-2-3 - ru translate (Google Translate service)
 * 
 *     # [v2] non-official extended (loverslab.com/files/file/10343-apropos2-text-db-update)
 *     db-2-3-1 - fixed json bugs
 *     db-2-3-2 - fixed grammar bugs (invalid brackets, punctuation marks, invalid spaces, aligns)
 * 
 * 
 * db-src
 *     db-2-myname-ru
 *     db-2-myname-en
 */
class AproposModule extends CWebModule
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setImport(array(
            'apropos.components.*',
			'apropos.helpers.*',
        ));
    }
}
