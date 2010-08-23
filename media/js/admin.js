    function translit(fname, sname)
    {
        var lat = {
            "а" : "a",
            "б" : "b",
            "в" : "v",
            "г" : "g",
            "д" : "d",
            "е" : "e",
            "ё" : "e",
            "ж" : "zh",
            "з" : "z",
            "и" : "i",
            "й" : "i",
            "к" : "k",
            "л" : "l",
            "м" : "m",
            "н" : "n",
            "о" : "o",
            "п" : "p",
            "р" : "r",
            "с" : "s",
            "т" : "t",
            "у" : "u",
            "ф" : "f",
            "х" : "h",
            "ц" : "c",
            "ч" : "ch",
            "ш" : "sh",
            "щ" : "sh",
            "ь" : "",
            "ъ" : "",
            "ы" : "y",
            "э" : "e",
            "ю" : "yu",
            "я" : "ya",
            " " : "-",
            "~" : "-",
            "`" : "-",
            "!" : "-",
            "@" : "-",
            "#" : "-",
            "$" : "-",
            "%" : "-",
            "^" : "-",
            "&" : "-",
            "*" : "-",
            "(" : "-",
            ")" : "-",
            "_" : "-",
            "=" : "-",
            "+" : "-",
            "{" : "-",
            "[" : "-",
            "}" : "-",
            "]" : "-",
            "\\" : "-",
            "|" : "-",
            "'" : "-",
            "\"" : "-",
            ":" : "-",
            ";" : "-",
            "?" : "-",
            "/" : "-",
            ">" : "-",
            "." : "-",
            "," : "-",
            "<" : "-",
            "№" : "-"
        };

        var i;

        for(i = 0; i < document.getElementsByName(fname).length; i++)
        {
            document.getElementsByName(sname)[i].value = strtr(document.getElementsByName(fname)[i].value.toLowerCase(), lat);
        }
    }

        function strtr (str, from, to) {
    	/*
    	* strtr by Kedo
    	* 2009
    	* Example 1: strtr('hi all, I said hello', {'hi':'hello', 'hello':'hi'}); //hello all, I said hi
    	* Example 2: strtr('abcdcdb', 'ab', 'AB')); //ABcdcdB
    	*/
        if (typeof from === 'object') {
        	var cmpStr = '';
        	for (var j=0; j < str.length; j++){
        		cmpStr += '0';
        	}
        	var offset = 0;
        	var find = -1;
        	var addStr = '';
            for (fr in from) {
            	offset = 0;
            	while ((find = str.indexOf(fr, offset)) != -1){
    				if (parseInt(cmpStr.substr(find, fr.length)) != 0){
    					offset = find + 1;
    					continue;
    				}
    				for (var k =0 ; k < from[fr].length; k++){
    					addStr += '1';
    				}
    				cmpStr = cmpStr.substr(0, find) + addStr + cmpStr.substr(find + fr.length, cmpStr.length - (find + fr.length));
    				str = str.substr(0, find) + from[fr] + str.substr(find + fr.length, str.length - (find + fr.length));
    				offset = find + from[fr].length;
    				addStr = '';
            	}
            }
            return str;
        }

    	for(var i = 0; i < from.length; i++) {
    		str = str.replace(new RegExp(from.charAt(i),'g'), to.charAt(i));
    	}

        return str;
    }