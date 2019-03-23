var el = wp.element.createElement;
var registerBlockType = wp.blocks.registerBlockType;
var RichText = wp.editor.RichText;
var InnerBlocks = wp.editor.InnerBlocks;

registerBlockType( 'libpreps/usewhen', {
    title: 'Use when',
    icon: 'editor-help',
    category: 'libpreps',
    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        }
    },
    edit: function( props ) {
        var content = props.attributes.content;
        function onChangeContent( newContent ) {
            props.setAttributes( { content: newContent } );
        }
        return [
            el( 'div', { className: props.className },
                el( InnerBlocks, {
                    className: 'libprepclassname',
                    // props.className,
                    onChange: onChangeContent,
                    value: content,
                    template: [
                        ['core/paragraph', { content: 'You may want to use this protocol when:' }],
                        ['core/list'],
                    ]
                } ),
            ),
        ];
    },
    save: function( props ) {
        var content = props.attributes.content;
        return [
            el( 'div', { className: props.className },
                el( InnerBlocks.Content, {
                    tagName: 'p',
                    className: props.className,
                    value: content
                } ),
            ),
        ];
    },
} );
