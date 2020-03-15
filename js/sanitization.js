function sanitize(value){
    value = stripSlashes(value);
    value = stripTags(value);
    return value;
}
function stripSlashes(str) {
    return str.replace(/\\/g, '');
}
function stripTags(input, allowed){
    allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');
    var tags = /<\/?([a-z0-9]*)\b[^>]*>?/gi;
    var php = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    var after = castString(input);
    after = (after.substring(after.length - 1) === '<') ? after.substring(0, after.length - 1) : after;
    while (true) {
        var before = after;
        after = before.replace(php, '').replace(tags, function ($0, $1) {
            return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
        });
        if (before === after) {return after;}
    }

}
function castString (value) {
    var type = typeof value;
    switch (type) {
        case 'boolean':
            return value ? '1' : '';
        case 'string':
            return value;
        case 'number':
            if (isNaN(value)) {return 'NAN';}
            if (!isFinite(value)) {return (value < 0 ? '-' : '') + 'INF'}
            return value + '';
        case 'undefined':
            return '';
        case 'object':
            if (Array.isArray(value)) {return 'Array';}
            if (value !== null) {return 'Object';}
            return '';
        case 'function':
        default:
            throw new Error('Unsupported value type')
    }
}